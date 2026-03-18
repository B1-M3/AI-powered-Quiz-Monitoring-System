# STEP 25: Language Files & API Routes (Apexia)

## Language files (localization)

**Location:** `lang/en/` and `lang/si/` (Sinhala – Sri Lanka).

### English (`lang/en/`)

| File | Purpose |
|------|--------|
| `messages.php` | General UI strings (welcome, dashboard, quiz, roles) |
| `validation.php` | Validation messages (required, email, max, min, unique) |
| `auth.php` | Login/auth messages (failed, throttle) |
| `roles.php` | Role labels (student, lecturer, developer) |
| `quiz.php` | Quiz UI (title, start, submit, ai_monitoring) |
| `attendance.php` | Attendance (present, absent, late, excused) |
| `clearance.php` | Clearance types and statuses |
| `ai-warnings.php` | AI proctoring warnings (face, tab switch, looking away) |

### Sinhala (`lang/si/`)

Same structure with Sinhala translations for messages, validation, auth, roles, quiz, attendance, clearance, and ai-warnings.

### Usage in Blade / PHP

```php
// In Blade
{{ __('messages.welcome') }}
{{ __('quiz.ai_monitoring') }}
{{ __('ai-warnings.tab_switch') }}

// Switch locale (e.g. in middleware or controller)
App::setLocale('si');  // Sinhala
App::setLocale('en');  // English
```

### Config

- Default locale: `config/app.php` → `'locale' => 'en'`, `'fallback_locale' => 'en'`.
- To add more locales, create `lang/<locale>/` with the same file names.

---

## API routes (Apexia quiz monitoring)

**Base URL:** `/api` (prefix applied by `RouteServiceProvider`).

All Apexia API routes require authentication (`auth:sanctum`). Use Sanctum tokens for SPA/mobile, or session for same-origin requests.

| Method | Endpoint | Purpose |
|--------|----------|--------|
| POST | `/api/quiz/start` | Start a quiz attempt (body: `quiz_id`) |
| POST | `/api/quiz/submit-answer` | Submit an answer (body: `attempt_id`, `question_id`, `answer`) |
| POST | `/api/ai/detection` | Send AI proctoring event (body: `attempt_id`, `type`, `value`) |
| GET | `/api/risk-scores/{quizId}` | Get risk scores for a quiz (lecturer/developer) |
| POST | `/api/video/upload-segment` | Upload video segment (body: `attempt_id`, `segment`) |
| GET | `/api/notifications` | List current user notifications |
| POST | `/api/warning/acknowledge` | Student acknowledges a warning (body: `attempt_id`, `warning_id`) |

**Controller:** `App\Http\Controllers\Api\ApexiaQuizApiController`.

---

## Broadcast channels (`routes/channels.php`)

- `App.Models.User.{id}` – user private channel (existing).
- `quiz.attempt.{attemptId}` – quiz attempt channel for real-time proctoring alerts (lecturer/developer only).

---

## Commands

```bash
# Clear config/cache after adding lang or routes
php artisan config:clear
php artisan route:clear

# List API routes
php artisan route:list --path=api
```
