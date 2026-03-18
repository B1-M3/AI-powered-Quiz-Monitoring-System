# Apexia AI Quiz Monitoring – Remaining Files Guide

This guide lists **all remaining files** from the COMPLETE ENHANCED WORKFLOW (Steps 13–24) and how to add them.

---

## Command to create Request + Trait files

From project root run:

```bash
php scripts/create_apexia_files.php
```

This creates: Lecturer requests (StoreQuiz, UpdateQuiz, AIConfiguration, GradeSubmission, AttendanceMark), Developer CreateUser/UpdateUser, and Traits (RoleCheck, Impersonation, AuditLog).

---

## STEP 13: Request/Validation Files

**Created (by script or manually):**  
- `app/Http/Requests/Auth/RegisterRequest.php`  
- `app/Http/Requests/Student/StoreStudentRequest.php`, `UpdateStudentRequest.php`, `QuizSubmissionRequest.php`  
- `app/Http/Requests/Lecturer/StoreQuizRequest.php`, `UpdateQuizRequest.php`, `AIConfigurationRequest.php`, `GradeSubmissionRequest.php`, `AttendanceMarkRequest.php`  
- `app/Http/Requests/Developer/CreateUserRequest.php`, `UpdateUserRequest.php`, `SystemSettingRequest.php`, `AIModelUpdateRequest.php`

**Note:** Login uses existing `app/Http/Requests/LoginRequest.php` (root). Optional: add `app/Http/Requests/Auth/LoginRequest.php` that extends FormRequest with same rules if you want it under Auth.

Each extends `Illuminate\Foundation\Http\FormRequest`, implements `authorize()` and `rules()`.

---

## STEP 14: Mail Classes

Create under `app/Mail/`:

- **Student:** `Student/QuizStartedMail.php`, `QuizCompletedMail.php`, `WarningReceivedMail.php`, `GradePublishedMail.php`, `ClearanceApprovedMail.php`
- **Lecturer:** `Lecturer/NewQuizCreatedMail.php`, `HighRiskAlertMail.php`, `StudentReferralMail.php`, `ProjectSubmissionMail.php`
- **Developer:** `Developer/SystemAlertMail.php`, `ErrorReportMail.php`, `DailySummaryMail.php`

Each extends `Illuminate\Mail\Mailable`, uses `implements ShouldQueue` (optional), and in `build()` calls `return $this->subject('...')->view('emails.xxx');`

---

## STEP 15: Notifications (Database)

Create under `app/Notifications/`:

- **Student:** `Student/QuizReminderNotification.php`, `WarningNotification.php`, `GradePublishedNotification.php`, `ClearanceUpdateNotification.php`
- **Lecturer:** `Lecturer/NewQuizNotification.php`, `PendingGradingNotification.php`, `HighRiskStudentNotification.php`, `AttendanceAlertNotification.php`
- **Developer:** `Developer/SystemHealthNotification.php`, `AIPerformanceNotification.php`, `ErrorNotification.php`

Each extends `Illuminate\Notifications\Notification` and implements `via()` (e.g. `['database','mail']`) and `toArray()`.

---

## STEP 16: Events & Listeners

**Events** (`app/Events/`):  
`Student/QuizStarted.php`, `QuizCompleted.php`, `WarningTriggered.php`, `CheatingDetected.php`, `GradeAssigned.php`  
`Lecturer/QuizCreated.php`, `QuizPublished.php`, `AttendanceMarked.php`  
`Developer/SystemError.php`, `AIDetectionFailed.php`, `StorageLow.php`

**Listeners** (`app/Listeners/`):  
`Student/SendQuizStartNotification.php`, `LogCheatingEvent.php`, `UpdateTrustScore.php`, `SendWarningEmail.php`  
`Lecturer/NotifyLecturerNewQuiz.php`, `UpdateRiskDashboard.php`  
`Developer/LogSystemError.php`, `SendAlertToDeveloper.php`, `CleanupOldLogs.php`

Register in `app/Providers/EventServiceProvider.php`:  
`protected $listen = [ \App\Events\Student\QuizStarted::class => [ \App\Listeners\Student\SendQuizStartNotification::class ], ... ];`

---

## STEP 17: Jobs

Create in `app/Jobs/`:  
`ProcessVideoRecording.php`, `CompressVideoFile.php`, `AnalyzeBehaviorLogs.php`, `GenerateRiskScores.php`,  
`SendBulkEmails.php`, `CleanupOldSessions.php`, `ExportAttendanceReport.php`, `BackupDatabase.php`

Each implements `ShouldQueue` and `handle()`.

---

## STEP 18: Console Commands

Create in `app/Console/Commands/`:  
`CalculateRiskScores.php`, `CleanupTempFiles.php`, `SendQuizReminders.php`, `GenerateDailyReports.php`,  
`BackupDatabase.php`, `ResetStudentSessions.php`, `SyncAttendance.php`, `TestAIModels.php`

Register in `app/Console/Kernel.php` in `$commands` and schedule in `schedule()` if needed.

---

## STEP 19: Traits

**Already created:** `app/Traits/PermissionTrait.php`

**Create:**  
`app/Traits/RoleCheckTrait.php`, `ImpersonationTrait.php`, `AuditLogTrait.php`,  
`AIDetectionTrait.php`, `VideoProcessingTrait.php`, `NotificationTrait.php`, `ClearanceWorkflowTrait.php`

---

## STEP 20: Services

Create under `app/Services/`:

- **AI:** `AI/FaceDetectionService.php`, `ObjectDetectionService.php`, `GazeTrackingService.php`, `RiskScoreCalculator.php`, `ModelManagerService.php`, etc.
- **Quiz:** `Quiz/QuizCreationService.php`, `ProctoringService.php`, `VideoRecordingService.php`, `GradingService.php`
- **Academic:** `Academic/AttendanceService.php`, `ClearanceService.php`, `RegistrationService.php`
- **Notification:** `Notification/EmailService.php`, `SMSService.php`
- **Developer:** `Developer/SystemHealthService.php`, `LogAnalysisService.php`, `BackupService.php`

---

## STEP 21: Repositories & Interfaces

**Repositories** (`app/Repositories/`):  
`UserRepository.php`, `StudentRepository.php`, `LecturerRepository.php`, `QuizRepository.php`,  
`AttendanceRepository.php`, `ClearanceRepository.php`, `AIDetectionRepository.php`, `LogRepository.php`

**Interfaces** (`app/Interfaces/`):  
`UserRepositoryInterface.php`, `QuizRepositoryInterface.php`, `AIDetectionInterface.php`, `NotificationInterface.php`

Bind in `AppServiceProvider`:  
`$this->app->bind(QuizRepositoryInterface::class, QuizRepository::class);`

---

## STEP 22: Policies

Create in `app/Policies/`:  
`QuizPolicy.php`, `AttendancePolicy.php`, `GradePolicy.php`, `StudentProfilePolicy.php`,  
`LecturerProfilePolicy.php`, `ClearancePolicy.php`, `AISettingsPolicy.php`

Register in `AuthServiceProvider`:  
`protected $policies = [ \App\Models\Quiz::class => \App\Policies\QuizPolicy::class, ... ];`

---

## STEP 23: View Composers

Create in `app/View/Composers/`:  
`NotificationComposer.php`, `SidebarComposer.php`, `RiskScoreComposer.php`,  
`ClearanceStatusComposer.php`, `SystemHealthComposer.php`

Register in `AppServiceProvider` or a dedicated provider:  
`View::composer('*', NotificationComposer::class);`

---

## STEP 24: Config

**Created:**  
`config/roles.php`, `config/permissions.php`, `config/ai-models.php`, `config/quiz-settings.php`,  
`config/attendance.php`, `config/clearance.php`, `config/developer.php`

---

## Commands to run after adding files

```bash
# Clear caches
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Run tests
php artisan test tests/Feature/ApexiaWorkflowTest.php --no-interaction
```

---

## Quick stub template (Request example)

```php
<?php
namespace App\Http\Requests\Lecturer;
use Illuminate\Foundation\Http\FormRequest;
class StoreQuizRequest extends FormRequest {
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'quiz_name' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,course_id',
            'total_questions' => 'required|integer|min:1',
            'time_limit_minutes' => 'required|integer|min:1',
        ];
    }
}
```

Use the same pattern for other FormRequests with appropriate `rules()`.

---

## What is already in the project

| Step | What was added |
|------|----------------|
| 13   | Auth/RegisterRequest; Student/Store, Update, QuizSubmission; Lecturer/StoreQuiz, UpdateQuiz, AIConfiguration, GradeSubmission, AttendanceMark; Developer/CreateUser, UpdateUser, SystemSetting, AIModelUpdate |
| 19   | Traits: RoleCheckTrait, ImpersonationTrait, AuditLogTrait, PermissionTrait |
| 23   | View/Composers/NotificationComposer.php |
| 24   | config/roles.php, permissions.php, ai-models.php, quiz-settings.php, attendance.php, clearance.php, developer.php |

**Command already run:** `php scripts/create_apexia_files.php` (creates Lecturer requests + Developer requests + Traits).  
To create the rest (Mail, Notifications, Events, Listeners, Jobs, Commands, Services, Repositories, Policies), add them one by one using the templates in this guide, or extend `scripts/create_apexia_files.php` with more entries.
