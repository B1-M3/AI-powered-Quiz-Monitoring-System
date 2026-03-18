

<?php $__env->startSection('title', 'APEXIA | Student Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<?php
    $isImpersonating = session('apexia_developer_id');
?>
<div class="container-fluid">
    <?php if($isImpersonating): ?>
        <div class="alert alert-warning alert-dismissible fade show mb-3" role="alert">
            <i class="ti ti-eye"></i> You are viewing as Student (developer mode). 
            <a href="<?php echo e(route('developer.exit.impersonation')); ?>" class="alert-link">Back to Developer Dashboard</a>.
        </div>
    <?php endif; ?>

    <?php if(!empty($noStudentRecord)): ?>
        <div class="alert alert-info mb-3">
            <i class="ti ti-info-circle"></i> No student record is linked to your account yet. You can still use Quizzes, Attendance, Clearance, and Profile. Contact administration to link your student record for full features.
        </div>
    <?php endif; ?>

    <div class="card shadow-sm p-4 mb-4 bg-white">
        <h3 class="fw-bold m-0">Welcome back, <?php echo e($user->name); ?>!</h3>
        <small class="text-muted"><?php if($student): ?> Student ID: <?php echo e($student->getFullId()); ?> <?php else: ?> Student account <?php endif; ?></small>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-primary text-white">
                <div class="card-body">
                    <h6 class="text-white-50">Courses</h6>
                    <h4 class="mb-0"><?php echo e($student ? $student->courseRegistrations()->count() : 0); ?></h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-success text-white">
                <div class="card-body">
                    <h6 class="text-white-50">Attendance</h6>
                    <h4 class="mb-0"><?php echo e($attendancePercent !== null ? $attendancePercent . '%' : 'N/A'); ?></h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-info text-white">
                <div class="card-body">
                    <h6 class="text-white-50">Current Semester</h6>
                    <h4 class="mb-0"><?php echo e($currentSemester ?? 'N/A'); ?></h4>
                </div>
            </div>
        </div>
    </div>

    
    <?php if(isset($yourCourses) && count($yourCourses) > 0): ?>
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-light">
            <h5 class="mb-0">Your courses</h5>
        </div>
        <div class="card-body">
            <ul class="list-unstyled mb-0">
                <?php $__currentLoopData = $yourCourses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $courseName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="d-flex align-items-center py-1"><i class="ti ti-book me-2 text-primary"></i><?php echo e($courseName); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
    <?php endif; ?>

    
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Notifications</h5>
            <a href="<?php echo e(route('student.quizzes')); ?>" class="btn btn-sm btn-outline-primary">View all quizzes</a>
        </div>
        <div class="card-body">
            <p class="text-muted small mb-3">When you attempt a quiz, your session will be recorded with AI monitoring (face, gaze, tab switch, multi-person, noise detection).</p>
            <?php if(isset($quizNotifications) && count($quizNotifications) > 0): ?>
                <?php $__currentLoopData = $quizNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $q): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="d-flex align-items-start mb-3 pb-3 border-bottom border-light">
                        <i class="ti ti-clipboard-list fs-4 text-success me-3 mt-1"></i>
                        <div class="flex-grow-1">
                            <strong>Quiz "<?php echo e($q->quiz_name); ?>"</strong> is available.
                            <br>
                            <small class="text-muted">Course: <?php echo e($q->course->course_name ?? 'N/A'); ?> · Deadline: <?php echo e($q->end_date ? $q->end_date->format('D, M j, Y g:i A') : 'N/A'); ?></small>
                            <br>
                            <a href="<?php echo e(route('student.quiz.take', $q->quiz_id)); ?>" class="btn btn-sm btn-success mt-2">Attempt quiz now</a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <p class="text-muted small mb-0">No new quiz notifications.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <a href="<?php echo e(route('student.quizzes')); ?>" class="text-decoration-none">
                <div class="card shadow-sm h-100 border-primary">
                    <div class="card-body text-center">
                        <i class="ti ti-clipboard-list fs-1 text-primary"></i>
                        <h6 class="mt-2">My Quizzes</h6>
                        <small class="text-muted">View & attempt</small>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="<?php echo e(route('student.attempts')); ?>" class="text-decoration-none">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="ti ti-history fs-1 text-info"></i>
                        <h6 class="mt-2">My Attempts</h6>
                        <small class="text-muted">Trust score & reports</small>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="<?php echo e(route('student.results')); ?>" class="text-decoration-none">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="ti ti-certificate fs-1 text-success"></i>
                        <h6 class="mt-2">Quiz Results</h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="<?php echo e(route('student.attendance')); ?>" class="text-decoration-none">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="ti ti-calendar-check fs-1 text-warning"></i>
                        <h6 class="mt-2">Attendance</h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="<?php echo e(route('student.clearance')); ?>" class="text-decoration-none">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="ti ti-file-check fs-1 text-secondary"></i>
                        <h6 class="mt-2">Clearance</h6>
                    </div>
                </div>
            </a>
        </div>
        <?php if($student): ?>
        <div class="col-md-3">
            <a href="<?php echo e(route('student_management.registration')); ?>" class="text-decoration-none">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="ti ti-user-plus fs-1 text-muted"></i>
                        <h6 class="mt-2">Student Registration</h6>
                    </div>
                </div>
            </a>
        </div>
        <?php endif; ?>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-light">
            <h5 class="mb-0">Clearance progress</h5>
        </div>
        <div class="card-body">
            <?php
                $cleared = collect($clearanceStatus)->filter()->count();
                $total = count($clearanceStatus);
                $pct = $total > 0 ? round(($cleared / $total) * 100) : 0;
            ?>
            <div class="progress mb-2" style="height: 24px;">
                <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo e($pct); ?>%;" aria-valuenow="<?php echo e($pct); ?>" aria-valuemin="0" aria-valuemax="100"><?php echo e($pct); ?>%</div>
            </div>
            <div class="small">
                Library: <?php echo e($clearanceStatus['library'] ? 'Done' : 'Pending'); ?> |
                Hostel: <?php echo e($clearanceStatus['hostel'] ? 'Done' : 'Pending'); ?> |
                Payment: <?php echo e($clearanceStatus['payment'] ? 'Done' : 'Pending'); ?> |
                Project: <?php echo e($clearanceStatus['project'] ? 'Done' : 'Pending'); ?>

            </div>
        </div>
    </div>


    <div class="card shadow-sm border-primary">
        <div class="card-body d-flex align-items-center">
            <i class="ti ti-shield-check fs-1 text-primary me-3"></i>
            <div>
                <h6 class="mb-0">Apexia Trust Score</h6>
                <small class="text-muted">AI monitoring compliance – good standing</small>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('inc.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\RPTP\Music\Apexia Academic Management System\resources\views/dashboards/student_dashboard.blade.php ENDPATH**/ ?>