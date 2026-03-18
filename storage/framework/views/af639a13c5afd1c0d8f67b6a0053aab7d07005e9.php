
<?php $__env->startSection('title', 'APEXIA | My Quiz Attempts'); ?>
<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="card shadow-sm p-4 mb-4">
        <h3 class="fw-bold m-0">Your quiz attempts</h3>
        <p class="text-muted small mb-0">View status, trust score, and integrity reports for each attempt.</p>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <?php $__empty_1 = true; $__currentLoopData = $attempts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attempt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="border-bottom p-4">
                    <div class="d-flex flex-wrap justify-content-between align-items-start gap-2">
                        <div>
                            <h5 class="mb-1"><?php echo e($attempt->quiz->quiz_name ?? 'Quiz'); ?></h5>
                            <p class="small text-muted mb-1">
                                Attempt started: <strong><?php echo e($attempt->started_at ? $attempt->started_at->format('M j, Y g:i A') : '-'); ?></strong>
                                <?php if($attempt->completed_at): ?>
                                    &middot; Completed: <strong><?php echo e($attempt->completed_at->format('M j, Y g:i A')); ?></strong>
                                <?php endif; ?>
                            </p>
                            <p class="small mb-0">
                                <?php
                                    $duration = $attempt->started_at && $attempt->completed_at
                                        ? $attempt->started_at->diffInMinutes($attempt->completed_at)
                                        : null;
                                ?>
                                <?php if($duration !== null): ?>
                                    Duration: <strong><?php echo e($duration); ?> min</strong> &middot;
                                <?php endif; ?>
                                Status: <span class="badge bg-<?php echo e($attempt->status === 'completed' ? 'success' : ($attempt->status === 'in_progress' ? 'warning' : 'secondary')); ?>"><?php echo e(ucfirst(str_replace('_', ' ', $attempt->status))); ?></span>
                                &middot;
                                Trust score: <strong><?php echo e($attempt->trust_score); ?>%</strong>
                                <?php if($attempt->trust_score >= 85): ?>
                                    <span class="text-success">Good</span>
                                <?php elseif($attempt->trust_score >= 60): ?>
                                    <span class="text-warning">Fair</span>
                                <?php else: ?>
                                    <span class="text-danger">Review</span>
                                <?php endif; ?>
                            </p>
                            <?php if($attempt->score !== null): ?>
                                <p class="small mb-0 mt-1">Grade: <strong><?php echo e($attempt->score); ?>/100</strong> <?php if($attempt->lecturer_feedback): ?> &middot; <?php echo e(\Illuminate\Support\Str::limit($attempt->lecturer_feedback, 60)); ?> <?php endif; ?></p>
                            <?php else: ?>
                                <p class="small text-muted mb-0 mt-1">Grade: Pending (lecturer review)</p>
                            <?php endif; ?>
                        </div>
                        <a href="<?php echo e(route('student.integrity_report', $attempt->attempt_id)); ?>" class="btn btn-outline-primary btn-sm">View integrity report</a>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="p-4 text-center text-muted">
                    <i class="ti ti-clipboard-off fs-1 d-block mb-2"></i>
                    No quiz attempts yet. <a href="<?php echo e(route('student.quizzes')); ?>">Take a quiz</a> to see your attempts here.
                </div>
            <?php endif; ?>
        </div>
        <?php if($attempts->hasPages()): ?>
            <div class="card-footer"><?php echo e($attempts->links()); ?></div>
        <?php endif; ?>
    </div>

    <div class="mt-3">
        <a href="<?php echo e(route('student.dashboard')); ?>" class="btn btn-outline-secondary">Back to dashboard</a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('inc.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\RPTP\Music\Apexia Academic Management System\resources\views/student/attempts.blade.php ENDPATH**/ ?>