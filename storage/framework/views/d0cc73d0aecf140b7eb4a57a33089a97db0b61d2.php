

<?php $__env->startSection('title', 'APEXIA | My Courses'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="card shadow-sm p-4 mb-4">
        <h3 class="fw-bold m-0">Course management</h3>
    </div>
    <div class="row g-3">
        <?php $__empty_1 = true; $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo e($course->course_name ?? 'Course'); ?></h5>
                        <p class="small text-muted mb-0"><?php echo e($course->course_id); ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-12"><div class="alert alert-info">No courses assigned.</div></div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('inc.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\RPTP\Music\Apexia Academic Management System\resources\views/lecturer/courses.blade.php ENDPATH**/ ?>