# STEP 12: APEXIA AI Quiz Monitoring – Complete file structure

This document lists the main files and how they link for the Apexia workflow (Student, Lecturer, Developer roles, impersonation, AI monitoring).

---

## App: Controllers

| Path | Purpose |
|------|---------|
| `app/Http/Controllers/LoginController.php` | Login; redirects by role (student/lecturer/developer dashboard). |
| `app/Http/Controllers/DashboardController.php` | Default dashboard; role-based redirect. |
| `app/Http/Controllers/Developer/RoleSwitchController.php` | Impersonate, leaveImpersonation, showSwitchPanel. |
| `app/Http/Controllers/DeveloperDashboardController.php` | Developer dashboard, switchToRole (delegates to RoleSwitchController), system health, AI models, logs, user management. |
| `app/Http/Controllers/Student/StudentDashboardController.php` | Student dashboard, quizzes, take quiz, results, attendance, clearance, profile. |
| `app/Http/Controllers/Lecturer/LecturerDashboardController.php` | Lecturer dashboard, create quiz, AI settings, risk dashboard, review/grade, courses, attendance. |

---

## App: Middleware

| Path | Purpose |
|------|---------|
| `app/Http/Middleware/CheckRole.php` | Role protection (role:Student,Lecturer,Developer); Developer can access all. |
| `app/Http/Middleware/RoleMiddleware.php` | APEXIA role middleware (same idea; Developer can access all). |
| `app/Http/Middleware/ImpersonationMiddleware.php` | Shares impersonating flag with views; blocks critical actions when impersonating. |
| `app/Http/Middleware/LogImpersonationMiddleware.php` | Logs developer actions during impersonation to dev_switch_logs. |

---

## App: Models

| Path | Purpose |
|------|---------|
| `app/Models/User.php` | User; getRole(), isStudent(), isLecturer(), isDeveloper(), getRedirectRoute(). |
| `app/Models/Student.php` | Student (students table); linked via user_id. |
| `app/Models/LecturerProfile.php` | Lecturer profile (lecturer_profiles table). |
| `app/Models/RolePermission.php` | role_permissions table; can(role, module, action). |
| `app/Models/DevSwitchLog.php` | dev_switch_logs table; logSwitch(), getTodayLogs(). |
| `app/Models/Quiz.php` | Quizzes. |

---

## App: Helpers

| Path | Purpose |
|------|---------|
| `app/Helpers/RoleHelper.php` | getAvailableRoles(), getRoleDisplayName(), getRoleDashboardRoute(), getModulePermissions(), canAccessModule(), getStudentFields(), getLecturerFields(), getDeveloperSwitchableRoles(), logRoleSwitch(), getImpersonationWarning(); ROLES, PERMISSIONS. |

---

## Database

| Path | Purpose |
|------|---------|
| `database/migrations/..._create_users_table.php` | users table. |
| `database/migrations/..._create_students_table.php` | students table. |
| `database/migrations/..._create_lecturer_profiles_table.php` | lecturer_profiles table. |
| `database/migrations/..._create_role_permissions_table.php` | role_permissions table. |
| `database/migrations/..._create_dev_switch_logs_table.php` | dev_switch_logs table. |
| `database/seeders/UsersTableSeeder.php` | Admin, Program Admin, Developer user. |
| `database/seeders/RolePermissionSeeder.php` | Student (view), Lecturer (create/edit/approve), Developer (full). |
| `database/seeders/StudentProfileSeeder.php` | Sample student users + first 3 with students table records. |
| `database/seeders/LecturerProfileSeeder.php` | Sample lecturers (User + LecturerProfile). |
| `database/seeders/DeveloperSeeder.php` | developer@apexia.com, role developer. |
| `database/seeders/DatabaseSeeder.php` | Calls all seeders above. |

---

## Resources: Views

| Path | Purpose |
|------|---------|
| `resources/views/inc/app.blade.php` | Main layout; red impersonation banner when apoxia_developer_id in session. |
| `resources/views/login.blade.php` | Login form. |
| `resources/views/dashboards/developer_dashboard.blade.php` | Developer dashboard; role switcher link. |
| `resources/views/dashboards/student_dashboard.blade.php` | Student dashboard; Back to Developer when impersonating. |
| `resources/views/dashboards/lecturer_dashboard.blade.php` | Lecturer dashboard; Back to Developer when impersonating. |
| `resources/views/developer/role_switch_panel.blade.php` | List students/lecturers; [VIEW] to impersonate. |
| `resources/views/developer/system_health.blade.php` | System health. |
| `resources/views/developer/ai_models.blade.php` | AI models. |
| `resources/views/developer/logs.blade.php` | Logs. |
| `resources/views/student/*.blade.php` | quizzes, quiz_take, quiz_results, attendance, clearance, profile. |
| `resources/views/lecturer/*.blade.php` | quiz_create, risk_dashboard, review_attempt, courses, attendance_mark. |
| `resources/views/components/sidebar.blade.php` | Sidebar menu by role. |

---

## Public: JS (AI / Quiz)

| Path | Purpose |
|------|---------|
| `public/js/tensorflow/face-detection.js` | Face detection (Blazeface/MediaPipe). |
| `public/js/tensorflow/object-detection.js` | Object detection (e.g. phone, earbuds). |
| `public/js/tensorflow/gaze-tracking.js` | Gaze analysis. |
| `public/js/quiz/proctor.js` | Proctor: runs detection, POST to /api/quiz/proctor-alert. |
| `public/js/quiz/media-recorder.js` | Record and upload segments. |
| `public/js/quiz/warning-system.js` | Warnings (tab switch, etc.). |
| `public/js/student/quiz-taker.js` | Student quiz UI; starts proctor and warnings. |

---

## Routes

| Path | Purpose |
|------|---------|
| `routes/web.php` | All web routes: login, dashboard, student.*, lecturer.*, developer.*, api/quiz (proctor-alert, upload-segment). |

**Key route names:** `login`, `login.authenticate`, `dashboard`, `student.dashboard`, `lecturer.dashboard`, `developer.dashboard`, `developer.impersonate`, `developer.exit.impersonation`, `developer.role_switch_panel`, `student.quizzes`, `lecturer.quiz.create`, `lecturer.risk_dashboard`.

---

## Tests (STEP 11)

| Path | Purpose |
|------|---------|
| `tests/Feature/ApexiaWorkflowTest.php` | Login redirect (student/lecturer/developer), role protection (student/lecturer blocked; developer OK), impersonation (view as student, banner, exit), dev_switch_logs logging. |

---

## Docs

| Path | Purpose |
|------|---------|
| `docs/APEXIA-IMPERSONATION-FLOW.md` | Impersonation flow and links. |
| `docs/APEXIA-SEEDERS.md` | Seeders and commands. |
| `docs/APEXIA-FILE-STRUCTURE.md` | This file. |

---

## Commands

```bash
# Migrate
php artisan migrate

# Seed
php artisan db:seed

# Run APEXIA workflow tests (STEP 11)
php artisan test tests/Feature/ApexiaWorkflowTest.php

# On Windows 11: avoid "TTY mode is not supported" warning
php artisan test tests/Feature/ApexiaWorkflowTest.php --no-interaction
# Or double-click: run-apexia-tests.bat

# Clear caches
php artisan config:clear && php artisan route:clear && php artisan view:clear
```
