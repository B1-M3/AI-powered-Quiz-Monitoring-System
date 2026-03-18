<?php $__env->startSection('title', 'APEXIA | My Quizzes'); ?>
<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <?php if(session('error')): ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="ti ti-alert-circle me-2"></i><?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php if(session('info')): ?>
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <i class="ti ti-info-circle me-2"></i><?php echo e(session('info')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php if(!$student): ?>
        <div class="alert alert-info mb-3">
            <i class="ti ti-info-circle me-2"></i>Your account is not yet linked to a student record. You can see available quizzes below. To <strong>attempt</strong> a quiz, contact administration to link your student record.
        </div>
    <?php endif; ?>
    <div class="card shadow-sm p-4 mb-4">
        <h3 class="fw-bold m-0">Available quizzes</h3>
        <p class="text-muted small mb-0">Attempt quizzes before the deadline. Your session will be recorded with AI monitoring (face detection, gaze tracking, tab switch, multi-person & noise detection).</p>
    </div>

    
    <h5 class="mb-3">Available now</h5>
    <?php if(isset($availableQuizzes) && $availableQuizzes->count() > 0): ?>
        <?php $__currentLoopData = $availableQuizzes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quiz): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between flex-wrap gap-2">
                        <div>
                            <h5 class="mb-1"><i class="ti ti-clipboard-list text-success me-2"></i><?php echo e($quiz->quiz_name); ?></h5>
                            <p class="text-muted small mb-1">Course: <strong><?php echo e($quiz->course->course_name ?? 'N/A'); ?></strong></p>
                            <p class="small mb-1">
                                Opens: <strong>Now</strong> &middot;
                                Closes: <strong><?php echo e($quiz->end_date ? $quiz->end_date->format('M j, Y g:i A') : 'N/A'); ?></strong>
                            </p>
                            <p class="small mb-0">
                                Duration: <strong><?php echo e($quiz->time_limit_minutes ?? 60); ?></strong> min &middot;
                                Attempts: <strong><?php echo e($quiz->attempts_allowed ?? 2); ?></strong> allowed
                            </p>
                        </div>
                        <a href="<?php echo e(route('student.quiz.take', $quiz->quiz_id)); ?>" class="btn btn-success">Attempt quiz now</a>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
        <div class="alert alert-info">No quizzes available to attempt right now.</div>
    <?php endif; ?>

    
    <h5 class="mb-3 mt-4">Upcoming</h5>
    <?php if(isset($upcomingQuizzes) && $upcomingQuizzes->count() > 0): ?>
        <?php $__currentLoopData = $upcomingQuizzes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quiz): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card shadow-sm mb-3 border-light">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between flex-wrap gap-2">
                        <div>
                            <h5 class="mb-1"><i class="ti ti-clipboard-list text-secondary me-2"></i><?php echo e($quiz->quiz_name); ?></h5>
                            <p class="text-muted small mb-1">Course: <strong><?php echo e($quiz->course->course_name ?? 'N/A'); ?></strong></p>
                            <p class="small mb-0">Opens: <strong><?php echo e($quiz->start_date ? $quiz->start_date->format('M j, Y g:i A') : 'N/A'); ?></strong></p>
                        </div>
                        <span class="btn btn-outline-secondary disabled">Not available</span>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
        <p class="text-muted small">No upcoming quizzes.</p>
    <?php endif; ?>

    <div class="mt-4">
        <a href="<?php echo e(route('student.dashboard')); ?>" class="btn btn-outline-secondary">Back to dashboard</a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('inc.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\RPTP\Music\Apexia Academic Management System\resources\views/student/quizzes.blade.php ENDPATH**/ ?>