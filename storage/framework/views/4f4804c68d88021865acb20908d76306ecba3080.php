<?php $__env->startSection('title', 'APEXIA | Quiz Question Pool'); ?>
<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="card shadow-sm p-4 mb-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h3 class="fw-bold m-0"><?php echo e($quiz->quiz_name); ?></h3>
                <p class="text-muted small mb-0 mt-1">
                    Question pool: <strong><?php echo e($quiz->questions->count()); ?></strong> questions
                    <?php if($quiz->questions_per_attempt): ?>
                        · Each student gets <strong><?php echo e($quiz->questions_per_attempt); ?></strong> random questions
                    <?php else: ?>
                        · Each student gets all questions
                    <?php endif; ?>
                </p>
            </div>
            <a href="<?php echo e(route('lecturer.dashboard')); ?>" class="btn btn-outline-secondary">Back to dashboard</a>
        </div>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <i class="ti ti-check me-2"></i><?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow-sm p-4 mb-4">
                <h5 class="mb-3">Bulk add questions</h5>
                <p class="small text-muted">Paste one question per line (e.g. 50 questions). Lines starting with "Question 1", "Question 2" are cleaned automatically.</p>
                <div class="mb-3">
                    <form action="<?php echo e(route('lecturer.quiz.questions.load_preset_dsp', $quiz->quiz_id)); ?>" method="POST" class="d-inline">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-success">
                            <i class="ti ti-file-plus me-1"></i> Add 50 preset questions (DSP & Image Processing)
                        </button>
                    </form>
                    <span class="small text-muted ms-2">One-click: 50 questions, 3 min each, 5 random per student.</span>
                </div>
                <form action="<?php echo e(route('lecturer.quiz.questions.store', $quiz->quiz_id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label class="form-label">Minutes per question (for new questions)</label>
                        <input type="number" name="time_limit_minutes" class="form-control" min="1" max="30" value="3" placeholder="3">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Questions (one per line)</label>
                        <textarea name="bulk_questions" class="form-control font-monospace" rows="12" placeholder="What is a signal? Briefly explain...&#10;Describe the main stages..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Add all</button>
                </form>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card shadow-sm p-4 mb-4">
                <h5 class="mb-3">Add one question</h5>
                <form action="<?php echo e(route('lecturer.quiz.questions.store', $quiz->quiz_id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label class="form-label">Question text</label>
                        <textarea name="question_text" class="form-control" rows="3" required placeholder="e.g. What is the Nyquist-Shannon sampling theorem?"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Minutes to answer</label>
                        <input type="number" name="time_limit_minutes" class="form-control" min="1" max="30" value="3">
                    </div>
                    <button type="submit" class="btn btn-outline-primary">Add question</button>
                </form>
            </div>
        </div>
    </div>

    <div class="card shadow-sm p-4">
        <h5 class="mb-3">Current question pool (<?php echo e($quiz->questions->count()); ?>)</h5>
        <?php if($quiz->questions->isEmpty()): ?>
            <p class="text-muted mb-0">No questions yet. Use bulk add or add one above.</p>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Question</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $quiz->questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $q): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><span class="text-break"><?php echo e(Str::limit($q->question_text, 80)); ?></span></td>
                            <td><?php echo e($q->time_limit_minutes ?? 3); ?> min</td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('inc.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\RPTP\Music\Apexia Academic Management System\resources\views/lecturer/quiz_questions.blade.php ENDPATH**/ ?>