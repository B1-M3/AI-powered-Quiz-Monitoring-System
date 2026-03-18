

<?php $__env->startSection('title', 'APEXIA | Lecturer Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<?php
    $isImpersonating = session('apexia_developer_id');
?>
<div class="container-fluid">
    <?php if($isImpersonating): ?>
        <div class="alert alert-warning alert-dismissible fade show mb-3" role="alert">
            <i class="ti ti-eye"></i> You are viewing as Lecturer (developer mode). 
            <a href="<?php echo e(route('developer.exit.impersonation')); ?>" class="alert-link">Back to Developer Dashboard</a>.
        </div>
    <?php endif; ?>
    <?php if(!empty($noLecturerRecord)): ?>
        <div class="alert alert-info mb-3">
            <i class="ti ti-info-circle"></i> No lecturer profile is linked to your account yet. You can still use Create Quiz, Lecture Risk Analysis, and Attendance. Contact administration to link your lecturer profile for full course and grading features.
        </div>
    <?php endif; ?>
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show mb-3">
            <i class="ti ti-circle-check me-2"></i><?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show mb-3">
            <i class="ti ti-alert-circle me-2"></i><?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm p-4 mb-4 bg-white">
        <?php if($profile): ?>
            <h3 class="fw-bold m-0">Welcome, <?php echo e($profile->getFullTitle()); ?></h3>
            <small class="text-muted"><?php echo e($profile->department ?? 'Lecturer'); ?></small>
        <?php else: ?>
            <h3 class="fw-bold m-0">Welcome, <?php echo e($user->name); ?></h3>
            <small class="text-muted">Lecturer – create quizzes and use Lecture Risk Analysis below</small>
        <?php endif; ?>
    </div>

    
    <?php if(isset($myQuizzes) && $myQuizzes->count() > 0): ?>
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Your quizzes</h5>
            <a href="<?php echo e(route('lecturer.quiz.create')); ?>" class="btn btn-sm btn-primary">+ Create Quiz</a>
        </div>
        <div class="card-body p-0">
            <ul class="list-group list-group-flush">
                <?php $__currentLoopData = $myQuizzes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $q): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong><?php echo e($q->quiz_name); ?></strong>
                            <span class="text-muted small ms-2"><?php echo e($q->course->course_name ?? 'N/A'); ?> · <?php echo e($q->module->module_name ?? $q->module->module_code ?? 'N/A'); ?></span>
                            <br>
                            <small class="text-muted">Start: <?php echo e($q->start_date ? $q->start_date->format('M j, Y g:i A') : ''); ?> · End: <?php echo e($q->end_date ? $q->end_date->format('M j, Y g:i A') : ''); ?> · Status: <?php echo e($q->status); ?></small>
                        </div>
                        <div class="d-flex gap-1">
                            <a href="<?php echo e(route('lecturer.quiz.questions', $q->quiz_id)); ?>" class="btn btn-sm btn-outline-secondary">Questions</a>
                            <a href="<?php echo e(route('lecturer.risk_dashboard')); ?>" class="btn btn-sm btn-outline-primary">Lecture Risk Analysis</a>
                        </div>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
    <?php endif; ?>

    
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <a href="<?php echo e(route('lecturer.quiz.create')); ?>" class="btn btn-primary btn-lg w-100 py-3">
                <i class="ti ti-plus"></i> Create Quiz
            </a>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-warning text-dark">
                <div class="card-body">
                    <h6 class="text-dark opacity-75">Pending grading</h6>
                    <h4 class="mb-0">0</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <a href="<?php echo e(route('lecturer.attendance')); ?>" class="btn btn-success btn-lg w-100 py-3">
                <i class="ti ti-calendar-check"></i> Attendance quick-mark
            </a>
        </div>
    </div>

    
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Lecture Risk Analysis</h5>
            <a href="<?php echo e(route('lecturer.risk_dashboard')); ?>" class="btn btn-sm btn-outline-primary">Open</a>
        </div>
        <div class="card-body">
            <p class="text-muted small mb-0">Quiz recordings and accuracy levels from AI monitoring. Open to view attempts, play recordings, and see behaviour analysis.</p>
        </div>
    </div>

    
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Course management</h5>
            <a href="<?php echo e(route('lecturer.courses')); ?>" class="btn btn-sm btn-outline-primary">Manage courses</a>
        </div>
        <div class="card-body">
            <div class="row g-2">
                <?php $__empty_1 = true; $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="col-md-4">
                        <div class="card border">
                            <div class="card-body py-2">
                                <h6 class="mb-0"><?php echo e($course->course_name ?? 'Course'); ?></h6>
                                <small class="text-muted"><?php echo e($course->course_id); ?></small>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-muted small mb-0">No courses assigned.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    
    <?php if($profile && $profile->is_supervisor): ?>
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-light">
                <h5 class="mb-0">Project supervision</h5>
            </div>
            <div class="card-body">
                <p class="text-muted small mb-0">Students under your supervision will appear here.</p>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('inc.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\RPTP\Music\Apexia Academic Management System\resources\views/dashboards/lecturer_dashboard.blade.php ENDPATH**/ ?>