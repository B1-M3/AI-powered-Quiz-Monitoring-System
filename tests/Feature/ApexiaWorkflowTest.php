<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Student;
use App\Models\DevSwitchLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Http\Middleware\VerifyCsrfToken;

/**
 * STEP 11: Test Scenarios for APEXIA AI Quiz Monitoring System.
 * Uses application url() so request path matches routes (avoids 404 with subfolder APP_URL).
 */
class ApexiaWorkflowTest extends TestCase
{
    use RefreshDatabase;

    /** Paths relative to APP_URL - use url() so tests work with any APP_URL (e.g. subfolder). */
    protected function loginPath(): string
    {
        return parse_url(url('/login'), PHP_URL_PATH) ?: '/login';
    }

    /** Verify web routes are loaded (if this fails, later tests will 404). */
    public function test_login_page_is_reachable(): void
    {
        $response = $this->get($this->loginPath());
        $response->assertSuccessful();
    }

    protected function createUser(string $email, string $role, string $password = 'password123'): User
    {
        return User::create([
            'name' => ucfirst($role) . ' User',
            'email' => $email,
            'password' => Hash::make($password),
            'user_role' => ucfirst($role),
            'role' => strtolower($role),
            'status' => '1',
        ]);
    }

    /** Create a minimal students row for a user so student dashboard can render (no redirect). */
    protected function createStudentRecordForUser(User $user): Student
    {
        return Student::create([
            'user_id' => $user->user_id,
            'role' => 'student',
            'title' => 'Mr',
            'name_with_initials' => 'Test S.',
            'full_name' => 'Test Student',
            'gender' => 'Male',
            'id_type' => 'National id',
            'id_value' => 'test-id-' . $user->user_id,
            'institute_location' => 'Welisara',
            'status' => 'Unmarried',
        ]);
    }

    /** Login Test: Student -> student dashboard */
    public function test_student_logs_in_redirected_to_student_dashboard(): void
    {
        $this->withoutMiddleware(VerifyCsrfToken::class);
        $this->createUser('student@test.com', 'student');
        $response = $this->post($this->loginPath(), [
            'email' => 'student@test.com',
            'password' => 'password123',
        ]);
        $response->assertRedirect();
        $this->assertStringContainsString('student-dashboard', $response->headers->get('Location'));
        $this->assertAuthenticatedAs(User::where('email', 'student@test.com')->first());
    }

    /** Login Test: Lecturer -> lecturer dashboard */
    public function test_lecturer_logs_in_redirected_to_lecturer_dashboard(): void
    {
        $this->withoutMiddleware(VerifyCsrfToken::class);
        $this->createUser('lecturer@test.com', 'lecturer');
        $response = $this->post($this->loginPath(), [
            'email' => 'lecturer@test.com',
            'password' => 'password123',
        ]);
        $response->assertRedirect();
        $this->assertStringContainsString('lecturer-dashboard', $response->headers->get('Location'));
        $this->assertAuthenticatedAs(User::where('email', 'lecturer@test.com')->first());
    }

    /** Login Test: Developer -> developer dashboard */
    public function test_developer_logs_in_redirected_to_developer_dashboard(): void
    {
        $this->withoutMiddleware(VerifyCsrfToken::class);
        $this->createUser('developer@test.com', 'developer');
        $response = $this->post($this->loginPath(), [
            'email' => 'developer@test.com',
            'password' => 'password123',
        ]);
        $response->assertRedirect();
        $this->assertStringContainsString('developer-dashboard', $response->headers->get('Location'));
        $this->assertAuthenticatedAs(User::where('email', 'developer@test.com')->first());
    }

    /** Role Protection: Student cannot access lecturer dashboard */
    public function test_student_cannot_access_lecturer_dashboard(): void
    {
        $student = $this->createUser('student@test.com', 'student');
        $path = parse_url(url('/lecturer-dashboard'), PHP_URL_PATH) ?: '/lecturer-dashboard';
        $response = $this->actingAs($student)->get($path);
        $response->assertRedirect();
        $this->assertStringContainsString('dashboard', $response->headers->get('Location'));
    }

    /** Role Protection: Lecturer cannot access student quizzes */
    public function test_lecturer_cannot_access_student_quizzes(): void
    {
        $lecturer = $this->createUser('lecturer@test.com', 'lecturer');
        $path = parse_url(url('/student/quizzes'), PHP_URL_PATH) ?: '/student/quizzes';
        $response = $this->actingAs($lecturer)->get($path);
        $response->assertRedirect();
        $this->assertStringContainsString('dashboard', $response->headers->get('Location'));
    }

    /** Developer can access lecturer and student routes */
    public function test_developer_can_access_lecturer_and_student_routes(): void
    {
        $developer = $this->createUser('developer@test.com', 'developer');
        $path1 = parse_url(url('/lecturer-dashboard'), PHP_URL_PATH) ?: '/lecturer-dashboard';
        $path2 = parse_url(url('/student/quizzes'), PHP_URL_PATH) ?: '/student/quizzes';
        $r1 = $this->actingAs($developer)->get($path1);
        $r1->assertSuccessful();
        $r2 = $this->actingAs($developer)->get($path2);
        $r2->assertSuccessful();
    }

    /** Impersonation: Developer views as student; red banner; can exit */
    public function test_developer_impersonate_student_sees_student_dashboard_and_can_exit(): void
    {
        $developer = $this->createUser('developer@test.com', 'developer');
        $student = $this->createUser('student2@test.com', 'student');
        $this->createStudentRecordForUser($student); // so student dashboard renders instead of redirecting

        $impersonatePath = parse_url(url("/developer/impersonate/student/{$student->user_id}"), PHP_URL_PATH)
            ?: '/developer/impersonate/student/' . $student->user_id;

        $response = $this->actingAs($developer)->get($impersonatePath);
        $response->assertRedirect();
        $this->assertStringContainsString('student-dashboard', $response->headers->get('Location'));
        $response->assertSessionHas('apexia_developer_id', $developer->user_id);

        // Follow redirect so session (impersonated user) is used for next request
        $dashboardPath = parse_url($response->headers->get('Location'), PHP_URL_PATH) ?: '/student-dashboard';
        $dashboard = $this->get($dashboardPath);
        $dashboard->assertSuccessful();
        $dashboard->assertSee('IMPERSONATION', false);
        $dashboard->assertSee('Back to Developer', false);

        $exitPath = parse_url(url('/developer/exit-impersonation'), PHP_URL_PATH) ?: '/developer/exit-impersonation';
        $exit = $this->get($exitPath);
        $exit->assertRedirect();
        $this->assertStringContainsString('developer-dashboard', $exit->headers->get('Location'));
        $exit->assertSessionMissing('apexia_developer_id');
    }

    /** Logging: dev_switch_logs has entries after impersonation and exit */
    public function test_impersonation_and_exit_are_logged_in_dev_switch_logs(): void
    {
        $developer = $this->createUser('developer@test.com', 'developer');
        $student = $this->createUser('student2@test.com', 'student');
        $this->createStudentRecordForUser($student);

        $impersonatePath = parse_url(url("/developer/impersonate/student/{$student->user_id}"), PHP_URL_PATH)
            ?: '/developer/impersonate/student/' . $student->user_id;

        $this->actingAs($developer)->get($impersonatePath);
        $countAfterStart = DevSwitchLog::where('developer_id', $developer->user_id)->count();
        $this->assertGreaterThanOrEqual(1, $countAfterStart, 'At least one log entry after impersonate');

        $exitPath = parse_url(url('/developer/exit-impersonation'), PHP_URL_PATH) ?: '/developer/exit-impersonation';
        $this->get($exitPath);
        $countAfterExit = DevSwitchLog::where('developer_id', $developer->user_id)->count();
        $this->assertGreaterThanOrEqual(2, $countAfterExit, 'At least two log entries after exit');
    }
}
