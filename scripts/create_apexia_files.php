<?php

/**
 * Run from project root: php scripts/create_apexia_files.php
 * Creates remaining Apexia Request, Trait, and stub files.
 */

$base = dirname(__DIR__);

$files = [
    'app/Http/Requests/Lecturer/StoreQuizRequest.php' => <<<'PHP'
<?php
namespace App\Http\Requests\Lecturer;
use Illuminate\Foundation\Http\FormRequest;
class StoreQuizRequest extends FormRequest {
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'quiz_name' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,course_id',
            'module_id' => 'nullable|exists:modules,module_id',
            'total_questions' => 'required|integer|min:1|max:200',
            'time_limit_minutes' => 'required|integer|min:1|max:300',
            'instructions' => 'nullable|string|max:5000',
        ];
    }
}
PHP,
    'app/Http/Requests/Lecturer/UpdateQuizRequest.php' => <<<'PHP'
<?php
namespace App\Http\Requests\Lecturer;
use Illuminate\Foundation\Http\FormRequest;
class UpdateQuizRequest extends FormRequest {
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'quiz_name' => 'sometimes|string|max:255',
            'total_questions' => 'sometimes|integer|min:1|max:200',
            'time_limit_minutes' => 'sometimes|integer|min:1|max:300',
            'status' => 'nullable|in:draft,active,closed',
        ];
    }
}
PHP,
    'app/Http/Requests/Lecturer/AIConfigurationRequest.php' => <<<'PHP'
<?php
namespace App\Http\Requests\Lecturer;
use Illuminate\Foundation\Http\FormRequest;
class AIConfigurationRequest extends FormRequest {
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'quiz_id' => 'required|integer|exists:quizzes,quiz_id',
            'ai_monitoring_enabled' => 'nullable|boolean',
            'face_detection' => 'nullable|boolean',
            'gaze_tracking' => 'nullable|boolean',
        ];
    }
}
PHP,
    'app/Http/Requests/Lecturer/GradeSubmissionRequest.php' => <<<'PHP'
<?php
namespace App\Http\Requests\Lecturer;
use Illuminate\Foundation\Http\FormRequest;
class GradeSubmissionRequest extends FormRequest {
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'attempt_id' => 'required|integer|exists:quiz_attempts,attempt_id',
            'score' => 'required|numeric|min:0',
            'feedback' => 'nullable|string|max:2000',
        ];
    }
}
PHP,
    'app/Http/Requests/Lecturer/AttendanceMarkRequest.php' => <<<'PHP'
<?php
namespace App\Http\Requests\Lecturer;
use Illuminate\Foundation\Http\FormRequest;
class AttendanceMarkRequest extends FormRequest {
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'student_id' => 'required|integer|exists:students,student_id',
            'session_date' => 'required|date',
            'status' => 'required|in:present,absent,late,excused',
        ];
    }
}
PHP,
    'app/Http/Requests/Developer/CreateUserRequest.php' => <<<'PHP'
<?php
namespace App\Http\Requests\Developer;
use Illuminate\Foundation\Http\FormRequest;
class CreateUserRequest extends FormRequest {
    public function authorize(): bool {
        return $this->user() && $this->user()->isDeveloper();
    }
    public function rules(): array {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:student,lecturer,developer',
        ];
    }
}
PHP,
    'app/Http/Requests/Developer/UpdateUserRequest.php' => <<<'PHP'
<?php
namespace App\Http\Requests\Developer;
use Illuminate\Foundation\Http\FormRequest;
class UpdateUserRequest extends FormRequest {
    public function authorize(): bool {
        return $this->user() && $this->user()->isDeveloper();
    }
    public function rules(): array {
        return [
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'sometimes|string|in:student,lecturer,developer',
        ];
    }
}
PHP,
    'app/Traits/RoleCheckTrait.php' => <<<'PHP'
<?php
namespace App\Traits;
use Illuminate\Support\Facades\Auth;
trait RoleCheckTrait {
    public function isStudent(): bool {
        return Auth::check() && Auth::user()->getRole() === 'student';
    }
    public function isLecturer(): bool {
        return Auth::check() && Auth::user()->getRole() === 'lecturer';
    }
    public function isDeveloper(): bool {
        return Auth::check() && Auth::user()->getRole() === 'developer';
    }
}
PHP,
    'app/Traits/ImpersonationTrait.php' => <<<'PHP'
<?php
namespace App\Traits;
use Illuminate\Support\Facades\Session;
trait ImpersonationTrait {
    public function isImpersonating(): bool {
        return Session::has('apexia_developer_id');
    }
    public function getImpersonatingDeveloperId(): ?int {
        return Session::get('apexia_developer_id');
    }
}
PHP,
    'app/Traits/AuditLogTrait.php' => <<<'PHP'
<?php
namespace App\Traits;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
trait AuditLogTrait {
    protected function auditLog(string $action, array $data = []): void {
        Log::info($action, array_merge(['user_id' => Auth::id(), 'action' => $action], $data));
    }
}
PHP,
];

foreach ($files as $relPath => $content) {
    $full = $base . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $relPath);
    $dir = dirname($full);
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
    file_put_contents($full, $content);
    echo "Created: $relPath\n";
}
echo "Done.\n";
