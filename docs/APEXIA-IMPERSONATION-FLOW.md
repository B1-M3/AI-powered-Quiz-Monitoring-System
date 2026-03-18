# STEP 9: Developer role-switching (impersonation) flow

This document describes how developer role-switching works in the Apexia AI Quiz Monitoring System and lists relevant files and routes.

---

## Flow summary

1. **Developer logs in** with `developer@apexia.com` (or any user with role `Developer`).
2. **Developer sees dashboard** with **ROLE SWITCHER** (link to role switch panel or buttons on developer dashboard).
3. **Developer clicks [VIEW] under STUDENT or LECTURER** (or selects a specific user from the list).
4. **System checks:** Is user a developer? Is target role valid? Find target user (or sample).
5. **System creates impersonation session:**
   - Store original developer ID in session (`apexia_developer_id`)
   - Set session as target user (`Auth::login($targetUser)`)
   - Store `apexia_switched_role`, `apexia_impersonate_user_id`
   - Create log entry in `dev_switch_logs`
   - Redirect to student or lecturer dashboard
6. **Red banner at top:** "IMPERSONATION MODE - Viewing as Student" (or Lecturer) with **[BACK TO DEVELOPER DASHBOARD]**.
7. **Developer can navigate as student/lecturer** (view quizzes, results, attendance). Critical actions (e.g. change password, delete user) are blocked by middleware when impersonating.
8. **Developer clicks [BACK TO DEVELOPER DASHBOARD]** → system clears session, restores developer, logs exit in `dev_switch_logs`, redirects to developer dashboard.
9. **Developer can repeat** with LECTURER or STUDENT (switchable roles: `student`, `lecturer`).

---

## Relevant links (routes)

| Purpose | Route name | URL (example) |
|--------|------------|----------------|
| Developer dashboard (with role switcher) | `developer.dashboard` | `/developer-dashboard` |
| Role switch panel (list students/lecturers) | `developer.role_switch_panel` | `/developer/role-switch-panel` |
| Impersonate (start viewing as role/user) | `developer.impersonate` | `/developer/impersonate/{role}/{userId?}` |
| Exit impersonation (back to developer) | `developer.exit.impersonation` | `/developer/exit-impersonation` |
| Student dashboard (after switch) | `student.dashboard` | `/student/dashboard` (or student area) |
| Lecturer dashboard (after switch) | `lecturer.dashboard` | `/lecturer-dashboard` |

---

## Relevant files

| File | Purpose |
|------|---------|
| `app/Http/Controllers/Developer/RoleSwitchController.php` | `impersonate()`, `leaveImpersonation()`, `showSwitchPanel()` |
| `app/Models/DevSwitchLog.php` | Log entries for switch start/exit |
| `app/Http/Middleware/ImpersonationMiddleware.php` | Shares `impersonating` with views; blocks critical actions |
| `app/Http/Middleware/LogImpersonationMiddleware.php` | Optional: log each action during impersonation |
| `resources/views/inc/app.blade.php` | Red impersonation banner at top of every page when session has `apexia_developer_id` |
| `resources/views/dashboards/developer_dashboard.blade.php` | Developer home with Role Switcher link |
| `resources/views/developer/role_switch_panel.blade.php` | List of students/lecturers and [VIEW] to impersonate |
| `app/Helpers/RoleHelper.php` | `getDeveloperSwitchableRoles()`, `getImpersonationWarning()` |

---

## Session keys

- `apexia_developer_id` – Original developer’s user ID (restored on exit).
- `apexia_switched_role` – Current role being viewed (`student` or `lecturer`).
- `apexia_impersonate_user_id` – Target user ID being impersonated (or null if “view as role” only).

---

## Commands (after code changes)

```bash
php artisan config:clear
php artisan route:clear
php artisan view:clear
```
