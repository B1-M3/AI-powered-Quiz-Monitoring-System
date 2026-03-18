
<div>
    <?php
        use App\Helpers\RoleHelper;
        use Illuminate\Support\Facades\Route;
        
        $role = auth()->user()->user_role ?? '';
        $apexiaRole = auth()->check() ? auth()->user()->getRole() : null;
        
        // FIX: Define $currentRoute properly
        $currentRoute = Route::currentRouteName();
        
        // Debug: Uncomment to see current route
        // \Log::info('Sidebar Current Route:', ['route' => $currentRoute]);
    ?>
    <div class="brand-logo d-flex align-items-center justify-content-center py-3 position-relative w-100">
        <!-- Mobile close button (uses the same toggler JS) -->
          <a href="javascript:void(0)" aria-label="Close sidebar"
              class="nav-link sidebartoggler d-xl-none position-absolute top-0 end-0 mt-1 me-3">
            <i class="ti ti-x fs-5"></i>
        </a>
        <a href="<?php echo e($apexiaRole === 'student' ? route('student.dashboard') : ($apexiaRole === 'lecturer' ? route('lecturer.dashboard') : ($apexiaRole === 'developer' ? route('developer.dashboard') : url('/dashboard')))); ?>" class="text-nowrap logo-img">
            <img src="<?php echo e(asset('images/logos/apexia.png')); ?>" alt="Apexia" width="180">
        </a>
    </div>

    <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
        <ul class="metismenu" id="menu">
            
            <li class="nav-small-cap">
                <span class="nav-small-cap-text">HOME</span>
            </li>
            <?php if($apexiaRole === 'developer'): ?>
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e($currentRoute == 'developer.dashboard' ? 'active' : ''); ?>" href="<?php echo e(route('developer.dashboard')); ?>">
                        <span><i class="ti ti-layout-dashboard"></i></span>
                        <span class="hide-menu">Developer Dashboard</span>
                    </a>
                </li>
            <?php elseif(RoleHelper::hasPermission($role, 'dashboard') && $apexiaRole !== 'student' && $apexiaRole !== 'lecturer'): ?>
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e($currentRoute == 'dashboard' ? 'active' : ''); ?>" href="<?php echo e(route('dashboard')); ?>">
                        <span><i class="ti ti-layout-dashboard"></i></span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
            <?php endif; ?>

            
            <?php if($apexiaRole === 'student'): ?>
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e($currentRoute == 'student.dashboard' ? 'active' : ''); ?>" href="<?php echo e(route('student.dashboard')); ?>">
                        <span><i class="ti ti-school"></i></span>
                        <span class="hide-menu">Student Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e($currentRoute == 'student_management.registration' ? 'active' : ''); ?>" href="<?php echo e(route('student_management.registration')); ?>">
                        <span><i class="ti ti-user-plus"></i></span>
                        <span class="hide-menu">Student Registration</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e($currentRoute == 'student.quizzes' ? 'active' : ''); ?>" href="<?php echo e(route('student.quizzes')); ?>">
                        <span><i class="ti ti-clipboard-list"></i></span>
                        <span class="hide-menu">Quizzes</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e($currentRoute == 'student.results' ? 'active' : ''); ?>" href="<?php echo e(route('student.results')); ?>">
                        <span><i class="ti ti-certificate"></i></span>
                        <span class="hide-menu">Quiz Results</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e(in_array($currentRoute, ['student.attempts', 'student.integrity_report']) ? 'active' : ''); ?>" href="<?php echo e(route('student.attempts')); ?>">
                        <span><i class="ti ti-history"></i></span>
                        <span class="hide-menu">My Attempts</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e($currentRoute == 'student.attendance' ? 'active' : ''); ?>" href="<?php echo e(route('student.attendance')); ?>">
                        <span><i class="ti ti-calendar-check"></i></span>
                        <span class="hide-menu">Attendance</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e($currentRoute == 'student.clearance' ? 'active' : ''); ?>" href="<?php echo e(route('student.clearance')); ?>">
                        <span><i class="ti ti-file-check"></i></span>
                        <span class="hide-menu">Clearance</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e($currentRoute == 'student.profile' ? 'active' : ''); ?>" href="<?php echo e(route('student.profile')); ?>">
                        <span><i class="ti ti-user"></i></span>
                        <span class="hide-menu">My Profile</span>
                    </a>
                </li>
            <?php endif; ?>

            
            
            <?php if($apexiaRole === 'lecturer'): ?>
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e($currentRoute == 'lecturer.dashboard' ? 'active' : ''); ?>" href="<?php echo e(route('lecturer.dashboard')); ?>">
                        <span><i class="ti ti-user-star"></i></span>
                        <span class="hide-menu">Lecturer Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e($currentRoute == 'lecturer.quiz.create' ? 'active' : ''); ?>" href="<?php echo e(route('lecturer.quiz.create')); ?>">
                        <span><i class="ti ti-plus"></i></span>
                        <span class="hide-menu">Create Quiz</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e($currentRoute == 'lecturer.risk_dashboard' ? 'active' : ''); ?>" href="<?php echo e(route('lecturer.risk_dashboard')); ?>">
                        <span><i class="ti ti-chart-line"></i></span>
                        <span class="hide-menu">Lecture Risk Analysis</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e($currentRoute == 'lecturer.courses' ? 'active' : ''); ?>" href="<?php echo e(route('lecturer.courses')); ?>">
                        <span><i class="ti ti-books"></i></span>
                        <span class="hide-menu">My Courses</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e($currentRoute == 'lecturer.attendance' ? 'active' : ''); ?>" href="<?php echo e(route('lecturer.attendance')); ?>">
                        <span><i class="ti ti-calendar-check"></i></span>
                        <span class="hide-menu">Attendance</span>
                    </a>
                </li>
            <?php endif; ?>

            
            <?php if($apexiaRole !== 'student' && $apexiaRole !== 'lecturer'): ?>

            
            <?php if($role == 'Program Administrator (level 01)' || $role == 'Developer'): ?>
            <li class="nav-small-cap">
                <span class="nav-small-cap-text">USER MANAGEMENT</span>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link <?php echo e($currentRoute == 'create.user' ? 'active' : ''); ?>" href="<?php echo e(route('create.user')); ?>">
                    <span><i class="ti ti-user"></i></span>
                    <span class="hide-menu">Create User</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link <?php echo e($currentRoute == 'dgm.user.management' ? 'active' : ''); ?>" href="<?php echo e(route('dgm.user.management')); ?>">
                    <span><i class="ti ti-users"></i></span>
                    <span class="hide-menu">User Management</span>
                </a>
            </li>
            <?php endif; ?>

            
            <?php if(
                RoleHelper::hasPermission($role, 'student.registration') ||
                RoleHelper::hasPermission($role, 'student.other.information') ||
                RoleHelper::hasPermission($role, 'student.list') ||
                RoleHelper::hasPermission($role, 'student.view') ||
                RoleHelper::hasPermission($role, 'course.badge') ||
                RoleHelper::hasPermission($role, 'student.profile')
                ): ?>
                <li class="nav-small-cap">
                    <span class="nav-small-cap-text">STUDENT MANAGEMENT</span>
                </li>
            <?php endif; ?>
            <?php if(RoleHelper::hasPermission($role, 'student.registration')): ?>
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e($currentRoute == 'student_management.registration' ? 'active' : ''); ?>" href="<?php echo e(route('student_management.registration')); ?>">
                        <span><i class="ti ti-user"></i></span>
                        <span class="hide-menu">Student Registration</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if(RoleHelper::hasPermission($role, 'student.other.information')): ?>
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e($currentRoute == 'student_management.other.information' ? 'active' : ''); ?>" href="<?php echo e(route('student_management.other.information')); ?>">
                        <span><i class="ti ti-layout"></i></span>
                        <span class="hide-menu">Student Other Information</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if(RoleHelper::hasPermission($role, 'student.list')): ?>
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e($currentRoute == 'student_management.list' ? 'active' : ''); ?>" href="<?php echo e(route('student_management.list')); ?>">
                        <span><i class="ti ti-menu"></i></span>
                        <span class="hide-menu">Student Lists</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if(RoleHelper::hasPermission($role, 'student.view')): ?>
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e($currentRoute == 'student_management.view' ? 'active' : ''); ?>" href="<?php echo e(route('student_management.view')); ?>">
                        <span><i class="ti ti-users"></i></span>
                        <span class="hide-menu">All Students View</span>
                    </a>
                </li>
            <?php endif; ?>
            
            <?php if(RoleHelper::hasPermission($role, 'student.profile')): ?>
                <li class="sidebar-item">
                    <?php
                        $user = auth()->user();
                        $studentProfileUrl = isset($user->student_id) && $user->student_id
                            ? route('student_management.profile', ['studentId' => $user->student_id])
                            : route('student_management.profile', ['studentId' => 0]);
                    ?>
                    <a class="sidebar-link <?php echo e(str_contains($currentRoute, 'student_management.profile') ? 'active' : ''); ?>" href="<?php echo e($studentProfileUrl); ?>">
                        <span><i class="ti ti-id"></i></span>
                        <span class="hide-menu">Student Profile</span>
                    </a>
                </li>
            <?php endif; ?>

            
            <?php if(
                RoleHelper::hasPermission($role, 'course.registration') ||
                RoleHelper::hasPermission($role, 'eligibility.registration') ||
                RoleHelper::hasPermission($role, 'semester.registration') ||
                RoleHelper::hasPermission($role, 'module.management') ||
                RoleHelper::hasPermission($role, 'uh.index.page') ||
                RoleHelper::hasPermission($role, 'course.change.index') ||
                RoleHelper::hasPermission($role, 'course.management')
                ): ?>
                
                <li class="nav-small-cap">
                    <span class="nav-small-cap-text">REGISTRATIONS</span>
                </li>
            <?php endif; ?>
            <?php if(RoleHelper::hasPermission($role, 'course.management')): ?>
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e($currentRoute == 'course.module.link' ? 'active' : ''); ?>" href="<?php echo e(route('course.module.link')); ?>">
                        <span><i class="ti ti-link"></i></span>
                        <span class="hide-menu">Link Course with Modules</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if(RoleHelper::hasPermission($role, 'course.registration')): ?>
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e($currentRoute == 'course.registration' ? 'active' : ''); ?>" href="<?php echo e(route('course.registration')); ?>">
                        <span><i class="ti ti-book"></i></span>
                        <span class="hide-menu">Course Registration</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if(RoleHelper::hasPermission($role, 'eligibility.registration')): ?>
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e($currentRoute == 'eligibility.registration' ? 'active' : ''); ?>" href="<?php echo e(route('eligibility.registration')); ?>">
                        <span><i class="ti ti-checks"></i></span>
                        <span class="hide-menu">Eligibility & Registration</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if(RoleHelper::hasPermission($role, 'semester.registration')): ?>
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e($currentRoute == 'semester.registration' ? 'active' : ''); ?>" href="<?php echo e(route('semester.registration')); ?>">
                        <span><i class="ti ti-calendar-stats"></i></span>
                        <span class="hide-menu">Semester Registration</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if(RoleHelper::hasPermission($role, 'module.management')): ?>
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e($currentRoute == 'module.management' ? 'active' : ''); ?>" href="<?php echo e(route('module.management')); ?>">
                        <span><i class="ti ti-briefcase"></i></span>
                        <span class="hide-menu">Elective Module Registrations</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if(RoleHelper::hasPermission($role, 'uh.index.page')): ?>
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e($currentRoute == 'uh.index.page' ? 'active' : ''); ?>" href="<?php echo e(route('uh.index.page')); ?>">
                        <span><i class="ti ti-id-badge"></i></span>
                        <span class="hide-menu">External Institute IDs</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if(RoleHelper::hasPermission($role, 'course.change')): ?>
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e($currentRoute == 'course.change.index' ? 'active' : ''); ?>" href="<?php echo e(route('course.change.index')); ?>">
                        <span><i class="ti ti-repeat"></i></span>
                        <span class="hide-menu">Course Change</span>
                    </a>
                </li>
            <?php endif; ?>

            
            <?php if(
                RoleHelper::hasPermission($role, 'exam.results') || 
                RoleHelper::hasPermission($role, 'student.exam.result.management') ||
                RoleHelper::hasPermission($role, 'exam.results.view.edit') ||
                RoleHelper::hasPermission($role, 'repeat.students.management')
                ): ?>
                <li class="nav-small-cap">
                    <span class="nav-small-cap-text">EXAMS & RESULTS</span>
                </li>
            <?php endif; ?>
            <?php if(RoleHelper::hasPermission($role, 'exam.results')): ?>
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e($currentRoute == 'student.exam.result.management' ? 'active' : ''); ?>" href="<?php echo e(route('student.exam.result.management')); ?>">
                        <span><i class="ti ti-file"></i></span>
                        <span class="hide-menu">Add Exam Result</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if(RoleHelper::hasPermission($role, 'exam.results.view.edit')): ?>
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e($currentRoute == 'exam.results.view.edit' ? 'active' : ''); ?>" href="<?php echo e(route('exam.results.view.edit')); ?>">
                        <span><i class="ti ti-edit"></i></span>
                        <span class="hide-menu">View & Edit Results</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if(RoleHelper::hasPermission($role, 'repeat.students.management')): ?>
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e($currentRoute == 'repeat.students.management' ? 'active' : ''); ?>" href="<?php echo e(route('repeat.students.management')); ?>">
                        <span><i class="ti ti-refresh"></i></span>
                        <span class="hide-menu">Repeat Students</span>
                    </a>
                </li>
            <?php endif; ?>

            
            
            
            <?php if(
                RoleHelper::hasPermission($role, 'quiz.creation') ||
                RoleHelper::hasPermission($role, 'quiz.scheduling') ||
                RoleHelper::hasPermission($role, 'quiz.monitoring') ||
                RoleHelper::hasPermission($role, 'quiz.results') ||
                RoleHelper::hasPermission($role, 'quiz.behavior.review') ||
                RoleHelper::hasPermission($role, 'quiz.student.index')
                ): ?>
                <li class="nav-small-cap">
                    <span class="nav-small-cap-text">QUIZ MONITORING SYSTEM</span>
                </li>
            <?php endif; ?>
            
            
            <?php if(RoleHelper::hasPermission($role, 'quiz.creation')): ?>
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e($currentRoute == 'quiz.create' ? 'active' : ''); ?>" href="<?php echo e(route('quiz.create')); ?>">
                        <span><i class="ti ti-plus"></i></span>
                        <span class="hide-menu">Create Quiz</span>
                    </a>
                </li>
            <?php endif; ?>
            
            <?php if(RoleHelper::hasPermission($role, 'quiz.scheduling')): ?>
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e($currentRoute == 'quiz.scheduling' ? 'active' : ''); ?>" href="<?php echo e(route('quiz.scheduling')); ?>">
                        <span><i class="ti ti-calendar"></i></span>
                        <span class="hide-menu">Quiz Scheduling</span>
                    </a>
                </li>
            <?php endif; ?>
            
            <?php if(RoleHelper::hasPermission($role, 'quiz.monitoring')): ?>
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e($currentRoute == 'quiz.monitoring.dashboard' ? 'active' : ''); ?>" href="<?php echo e(route('quiz.monitoring.dashboard')); ?>">
                        <span><i class="ti ti-eye"></i></span>
                        <span class="hide-menu">AI Quiz Monitoring</span>
                    </a>
                </li>
            <?php endif; ?>
            
            <?php if(RoleHelper::hasPermission($role, 'quiz.results')): ?>
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e($currentRoute == 'quiz.results' ? 'active' : ''); ?>" href="<?php echo e(route('quiz.results')); ?>">
                        <span><i class="ti ti-file-text"></i></span>
                        <span class="hide-menu">Quiz Results</span>
                    </a>
                </li>
            <?php endif; ?>
            
            <?php if(RoleHelper::hasPermission($role, 'quiz.behavior.review')): ?>
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e(in_array($currentRoute, ['quiz.behavior.list', 'quiz.behavior.review']) ? 'active' : ''); ?>" 
                       href="<?php echo e(route('quiz.behavior.list')); ?>">
                        <span><i class="ti ti-clipboard"></i></span>
                        <span class="hide-menu">Behavior Analysis</span>
                    </a>
                </li>
            <?php endif; ?>
            
            
            <?php if(RoleHelper::hasPermission($role, 'quiz.student.index')): ?>
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e($currentRoute == 'quiz.student.index' ? 'active' : ''); ?>" href="<?php echo e(route('quiz.student.index')); ?>">
                        <span><i class="ti ti-clipboard-check"></i></span>
                        <span class="hide-menu">My Quizzes</span>
                    </a>
                </li>
            <?php endif; ?>

            
            <?php if(
                RoleHelper::hasPermission($role, 'attendance') ||
                RoleHelper::hasPermission($role, 'overall.attendance')
                ): ?>
                <li class="nav-small-cap">
                    <span class="nav-small-cap-text">ATTENDANCE</span>
                </li>
            <?php endif; ?>
            <?php if(RoleHelper::hasPermission($role, 'attendance')): ?>
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e($currentRoute == 'attendance' ? 'active' : ''); ?>" href="<?php echo e(route('attendance')); ?>">
                        <span><i class="ti ti-id"></i></span>
                        <span class="hide-menu">Attendance</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if(RoleHelper::hasPermission($role, 'overall.attendance')): ?>
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e($currentRoute == 'overall.attendance' ? 'active' : ''); ?>" href="<?php echo e(route('overall.attendance')); ?>">
                        <span><i class="ti ti-id"></i></span>
                        <span class="hide-menu">Overall Attendance</span>
                    </a>
                </li>
            <?php endif; ?>
           
            
            <?php if(
                RoleHelper::hasPermission($role, 'all.clearance.management') ||
                RoleHelper::hasPermission($role, 'library.clearance') ||
                RoleHelper::hasPermission($role, 'hostel.clearance.form.management') ||
                RoleHelper::hasPermission($role, 'project.clearance.management') ||
                RoleHelper::hasPermission($role, 'payment.clearance')
                ): ?>
            <li class="nav-small-cap">
                <span class="nav-small-cap-text">STUDENT CLEARANCE</span>
            </li>
            <?php endif; ?>
            <?php if(RoleHelper::hasPermission($role, 'all.clearance.management')): ?>
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e($currentRoute == 'all.clearance.management' ? 'active' : ''); ?>" href="<?php echo e(route('all.clearance.management')); ?>">
                        <span><i class="ti ti-clipboard"></i></span>
                        <span class="hide-menu">All Clearance</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if(RoleHelper::hasPermission($role, 'library.clearance')): ?>
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e($currentRoute == 'library.clearance' ? 'active' : ''); ?>" href="<?php echo e(route('library.clearance')); ?>">
                        <span><i class="ti ti-clipboard"></i></span>
                        <span class="hide-menu">Library Clearance</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if(RoleHelper::hasPermission($role, 'hostel.clearance.form.management')): ?>
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e($currentRoute == 'hostel.clearance.form.management' ? 'active' : ''); ?>" href="<?php echo e(route('hostel.clearance.form.management')); ?>">
                        <span><i class="ti ti-note"></i></span>
                        <span class="hide-menu">Hostel Clearance</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if(RoleHelper::hasPermission($role, 'project.clearance.management')): ?>
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e($currentRoute == 'project.clearance.management' ? 'active' : ''); ?>" href="<?php echo e(route('project.clearance.management')); ?>">
                        <span><i class="ti ti-briefcase"></i></span>
                        <span class="hide-menu">Project Clearance</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if(RoleHelper::hasPermission($role, 'payment.clearance')): ?>            
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e($currentRoute == 'payment.clearance' ? 'active' : ''); ?>" href="<?php echo e(route('payment.clearance')); ?>">
                        <span><i class="ti ti-cash"></i></span>
                        <span class="hide-menu">Payment Clearance</span>
                    </a>
                </li>
            <?php endif; ?>

            
            <?php if(
                RoleHelper::hasPermission($role, 'module.creation') ||
                RoleHelper::hasPermission($role, 'course.management') ||
                RoleHelper::hasPermission($role, 'intake.create') ||             
                RoleHelper::hasPermission($role, 'semesters.create') ||
                RoleHelper::hasPermission($role, 'semester.management') ||
                RoleHelper::hasPermission($role, 'timetable')
                ): ?>
                <li class="nav-small-cap">
                    <span class="nav-small-cap-text">COURSES & MODULES</span>
                </li>
            <?php endif; ?>
            <?php if($role == 'Developer' || $role == 'Program Administrator (level 02)' || RoleHelper::hasPermission($role, 'module.creation')): ?>
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e($currentRoute == 'module.creation' ? 'active' : ''); ?>" href="<?php echo e(route('module.creation')); ?>">
                        <span><i class="ti ti-plus"></i></span>
                        <span class="hide-menu">Create New Modules</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if(RoleHelper::hasPermission($role, 'course.management')): ?>
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e($currentRoute == 'course.management' ? 'active' : ''); ?>" href="<?php echo e(route('course.management')); ?>">
                        <span><i class="ti ti-notebook"></i></span>
                        <span class="hide-menu">Create New Courses</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if(RoleHelper::hasPermission($role, 'intake.create')): ?>
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e($currentRoute == 'intake.create' ? 'active' : ''); ?>" href="<?php echo e(route('intake.create')); ?>">
                        <span><i class="ti ti-pencil"></i></span>
                        <span class="hide-menu">Create New Intakes</span>
                    </a>
                </li>
            <?php endif; ?>

            
            <?php if(
                RoleHelper::hasPermission($role, 'module.creation') ||
                RoleHelper::hasPermission($role, 'course.management') ||
                RoleHelper::hasPermission($role, 'intake.create') ||             
                RoleHelper::hasPermission($role, 'semesters.create') ||
                RoleHelper::hasPermission($role, 'semester.management') ||
                RoleHelper::hasPermission($role, 'timetable')
                ): ?>
                <li><hr class="my-2 border-gray-200 opacity-30"></li>
                <?php endif; ?>

            
            <?php if(RoleHelper::hasPermission($role, 'semesters.create')): ?>
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e($currentRoute == 'semesters.create' ? 'active' : ''); ?>" href="<?php echo e(route('semesters.create')); ?>">
                        <span><i class="ti ti-calendar"></i></span>
                        <span class="hide-menu">Create New Semesters</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e($currentRoute == 'semesters.index' ? 'active' : ''); ?>" href="<?php echo e(route('semesters.index')); ?>">
                        <span><i class="ti ti-list"></i></span>
                        <span class="hide-menu">Semester Management</span>
                    </a>
                </li>
            <?php endif; ?>
             <?php if(RoleHelper::hasPermission($role, 'timetable')): ?>
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e($currentRoute == 'timetable.show' ? 'active' : ''); ?>" href="<?php echo e(route('timetable.show')); ?>">
                        <span><i class="ti ti-calendar"></i></span>
                        <span class="hide-menu">Timetable</span>
                    </a>
                </li>
            <?php endif; ?>

            
            <?php if(
                RoleHelper::hasPermission($role, 'payment.dashboard') ||
                RoleHelper::hasPermission($role, 'payment.discounts') ||
                RoleHelper::hasPermission($role, 'payment.plan') ||
                RoleHelper::hasPermission($role, 'payment.plan.index') ||
                RoleHelper::hasPermission($role, 'payment') ||
                RoleHelper::hasPermission($role, 'misc.payment') ||
                RoleHelper::hasPermission($role, 'late.payment') ||
                RoleHelper::hasPermission($role, 'payment.discount.page') ||
                RoleHelper::hasPermission($role, 'repeat.students.payment')                
            ): ?>
                <li class="nav-small-cap">
                    <span class="nav-small-cap-text">FINANCIAL</span>
                </li>
            <?php endif; ?>
            <?php if(RoleHelper::hasPermission($role, 'payment.dashboard')): ?>
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e(request()->routeIs('payment.summary') ? 'active' : ''); ?>"href="<?php echo e(route('payment.summary')); ?>">
                        <span><i class="ti ti-chart-pie"></i></span>
                        <span class="hide-menu">Payment Dashboard</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if(RoleHelper::hasPermission($role, 'payment.discounts')): ?>
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e(request()->routeIs('payment.discount.page') ? 'active' : ''); ?>" href="<?php echo e(route('payment.discount.page')); ?>">
                        <span><i class="ti ti-discount"></i></span>
                        <span class="hide-menu">Create Discounts</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if(RoleHelper::hasPermission($role, 'payment.plan')): ?>
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e(request()->routeIs('payment.plan.index') ? 'active' : ''); ?>" href="<?php echo e(route('payment.plan.index')); ?>">
                        <span><i class="ti ti-cash"></i></span>
                        <span class="hide-menu">Existing Payment Plans</span>
                    </a>
                </li>
            <?php endif; ?>

            
            <?php if(
                RoleHelper::hasPermission($role, 'payment.dashboard') ||
                RoleHelper::hasPermission($role, 'payment.discounts') ||
                RoleHelper::hasPermission($role, 'payment.plan') ||
                RoleHelper::hasPermission($role, 'payment.plan.index') ||
                RoleHelper::hasPermission($role, 'payment') ||
                RoleHelper::hasPermission($role, 'misc.payment') ||
                RoleHelper::hasPermission($role, 'late.payment') ||
                RoleHelper::hasPermission($role, 'payment.discount.page') ||
                RoleHelper::hasPermission($role, 'repeat.students.payment')                
            ): ?>
            <li><hr class="my-2 border-gray-200 opacity-30"></li>
            <?php endif; ?>

            <?php if(RoleHelper::hasPermission($role, 'payment.plan.index')): ?>
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e(request()->routeIs('payment.plan') ? 'active' : ''); ?>" href="<?php echo e(route('payment.plan')); ?>">
                        <span><i class="ti ti-plus"></i></span>
                        <span class="hide-menu">Intake Payment Plan</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if(RoleHelper::hasPermission($role, 'payment')): ?>
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e(request()->routeIs('payment.index') ? 'active' : ''); ?>" href="<?php echo e(route('payment.index')); ?>">
                        <span><i class="ti ti-credit-card"></i></span>
                        <span class="hide-menu">Student Payment Plan</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if(RoleHelper::hasPermission($role, 'misc.payment')): ?>        
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e(request()->routeIs('misc.payment.index') ? 'active' : ''); ?>" href="<?php echo e(route('misc.payment.index')); ?>">
                        <span><i class="ti ti-wallet"></i></span>
                        <span class="hide-menu">Miscellaneous Payment</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if(RoleHelper::hasPermission($role, 'late.payment')): ?>
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e(request()->routeIs('late.payment.index') ? 'active' : ''); ?>" href="<?php echo e(route('late.payment.index')); ?>">
                        <span><i class="ti ti-clock"></i></span>
                        <span class="hide-menu">Late Payment</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if(RoleHelper::hasPermission($role, 'payment.showDownloadPage')): ?>
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e(request()->routeIs('payment.showDownloadPage') ? 'active' : ''); ?>"
                    href="<?php echo e(route('payment.showDownloadPage')); ?>">
                        <span><i class="ti ti-file-download"></i></span>
                        <span class="hide-menu">Payment Statements</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if(RoleHelper::hasPermission($role, 'repeat.students.payment')): ?>
                <li class="sidebar-item">
                    <a class="sidebar-link <?php echo e($currentRoute == 'repeat.payment.index' ? 'active' : ''); ?>" href="<?php echo e(route('repeat.payment.index')); ?>">
                        <span><i class="ti ti-currency-dollar"></i></span>
                        <span class="hide-menu">Repeat Payment Plan</span>
                    </a>
                </li>
            <?php endif; ?>

            
            <?php if(
                RoleHelper::hasPermission($role, 'special.approval') ||
                RoleHelper::hasPermission($role, 'latefee.approval.index')
                ): ?>
            <li class="nav-small-cap">
                <span class="nav-small-cap-text">APPROVALS</span>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link <?php echo e($currentRoute == 'special.approval.list' ? 'active' : ''); ?>" href="<?php echo e(route('special.approval.list')); ?>">
                    <span><i class="ti ti-check"></i></span>
                    <span class="hide-menu">Special Approval</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link <?php echo e(request()->routeIs('latefee.approval.index') ? 'active' : ''); ?>" href="<?php echo e(route('latefee.approval.index')); ?>">
                    <span><i class="ti ti-currency-dollar"></i></span>
                    <span class="hide-menu">Late Fee Approval</span>
                </a>
            </li>
            <?php endif; ?>

            <?php endif; ?>
            

            
            <hr>
            <div class="px-3 pb-3">
                <div class="bg-light rounded p-3 d-flex flex-column gap-2 align-items-center">
                    <a href="<?php echo e(route('user.profile')); ?>" class="btn w-100" style="background-color: #6c8cff; color: #fff; font-weight: 500;">My Profile</a>
                    <a href="<?php echo e(route('logout')); ?>" class="btn w-100" style="background-color: #ff8c7a; color: #fff; font-weight: 500;">Logout</a>
                </div>
            </div>

            
            <li id="teamNebulaLink" class="text-center mb-3" style="opacity: 0.8; font-size: 13px;">
                <a href="<?php echo e(route('team.phase.index')); ?>"
                class="text-decoration-none d-inline-block py-1 px-2 rounded
                        <?php echo e($currentRoute == 'team.phase.index'
                                ? 'bg-light text-primary fw-semibold shadow-sm' 
                                : 'text-muted'); ?>"
                style="transition: all 0.3s;">
                    © Team Apexia IT
                </a>
            </li>
        </ul>
    </nav>
</div>

            
            <?php if(Route::currentRouteName() == 'team.phase.index'): ?>
                <script nonce="<?php echo e($cspNonce); ?>">
                    document.addEventListener('DOMContentLoaded', function() {
                        const link = document.getElementById('teamNebulaLink');
                        if (link) {
                            // Find the SimpleBar content element and scroll to the footer link
                            const sidebar = document.querySelector('.scroll-sidebar [data-simplebar=""]') || document.querySelector('.scroll-sidebar');
                            link.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        }
                    });
                </script>
            <?php endif; ?>

        </ul>
    </nav>
</div><?php /**PATH C:\Users\RPTP\Desktop\Apexia Academic Management System\resources\views/components/sidebar.blade.php ENDPATH**/ ?>