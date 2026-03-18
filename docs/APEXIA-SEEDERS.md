# STEP 10: Database seeders (APEXIA)

Initial data for Student, Lecturer, Developer roles and role permissions.

---

## Seeder files and purpose

| File | Purpose |
|------|---------|
| `database/seeders/RolePermissionSeeder.php` | Set default permissions: **Student** (view only), **Lecturer** (create, edit, grade), **Developer** (full access). Modules: quiz, attendance, clearance, exams, dashboard, results. |
| `database/seeders/StudentProfileSeeder.php` | Create 10 sample student **users** (student1@apexia.com … student10@apexia.com). First 3 get linked **students** table records for impersonation. |
| `database/seeders/LecturerProfileSeeder.php` | Create 5 sample **lecturers** (User + LecturerProfile) with departments and designations (lecturer1@apexia.com … lecturer5@apexia.com). |
| `database/seeders/DeveloperSeeder.php` | Create/update **developer** account: developer@apexia.com, role = developer, password Dev123. |
| `database/seeders/UsersTableSeeder.php` | Existing: admin, Program Admin, and developer (can run before or after DeveloperSeeder). |

---

## Relevant links (Artisan commands)

```bash
# Run all seeders (order: Users, RolePermission, StudentProfile, LecturerProfile, Developer)
php artisan db:seed

# Run only APEXIA seeders
php artisan db:seed --class=RolePermissionSeeder
php artisan db:seed --class=StudentProfileSeeder
php artisan db:seed --class=LecturerProfileSeeder
php artisan db:seed --class=DeveloperSeeder

# Run single seeder
php artisan db:seed --class=UsersTableSeeder
```

---

## Default credentials after seeding

| Role | Email | Password |
|------|--------|----------|
| Developer | developer@apexia.com | Dev123 |
| Student (sample) | student1@apexia.com … student10@apexia.com | password123 |
| Lecturer (sample) | lecturer1@apexia.com … lecturer5@apexia.com | password123 |
| Admin | admin@apexia.com | password123 |
| Program Admin | pa1@apexia.com | password123 |

---

## DatabaseSeeder call order

`database/seeders/DatabaseSeeder.php` calls:

1. UsersTableSeeder  
2. RolePermissionSeeder  
3. StudentProfileSeeder  
4. LecturerProfileSeeder  
5. DeveloperSeeder  

Ensure migrations are run before seeding: `php artisan migrate`.
