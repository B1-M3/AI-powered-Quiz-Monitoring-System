<?php $__env->startSection('title', 'APEXIA | Review Attempt'); ?>
<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="card shadow-sm p-4 mb-4">
        <h3 class="fw-bold m-0">Review attempt</h3>
        <p class="text-muted small mb-0">Grade with AI assistance: manual override, Accept AI Recommendation, or add notes.</p>
    </div>
    <div class="card shadow-sm p-4 mb-3">
        <p><strong>Student:</strong> <?php echo e($attempt->student->full_name ?? $attempt->student->name_with_initials ?? 'N/A'); ?></p>
        <p><strong>Quiz:</strong> <?php echo e($attempt->quiz->quiz_name ?? 'N/A'); ?></p>
        <p><strong>Score:</strong> <?php echo e($attempt->score ?? '-'); ?> | <strong>Warning count:</strong> <?php echo e($attempt->warning_count ?? 0); ?> (<?php echo e($attempt->getSeverityLevel() ?? 'none'); ?>)</p>
        <p><strong>Accuracy level (integrity):</strong> <span class="badge bg-<?php echo e((int) $attempt->trust_score >= 85 ? 'success' : ((int) $attempt->trust_score >= 60 ? 'warning text-dark' : 'danger')); ?>"><?php echo e((int) $attempt->trust_score); ?>% · <?php echo e($attempt->integrity_rating ?? '—'); ?></span> — Auto-analysed from recording and behaviour logs.</p>
        <?php if(!empty($attempt->recording_path) || !empty($attempt->recording_segments)): ?>
        <div class="mt-3">
            <h6 class="mb-2"><i class="ti ti-video"></i> Proctoring recording</h6>
            <p class="text-muted small mb-2">Full session (e.g. 15 min for 5 questions). The student's <strong>face, eyes and behavior</strong> are recorded so you can see how they took the quiz and any cheating (looking away, tab switch, phone, etc.).</p>
            <?php if(!empty($attempt->room_scan_path)): ?>
            <p class="small mb-2"><a href="<?php echo e(url('/lecturer/attempt/' . $attempt->attempt_id . '/recording?segment=room_scan')); ?>" target="_blank" rel="noopener" class="text-primary">Room scan (10s)</a></p>
            <?php endif; ?>
            <?php if(!empty($attempt->recording_segments) && is_array($attempt->recording_segments)): ?>
            <p class="small mb-2">Per-question segments (video saved separately for each question):</p>
            <div class="d-flex flex-wrap gap-2 mb-2">
                <?php $__currentLoopData = $attempt->recording_segments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $segPath): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('lecturer.attempt.recording', ['attemptId' => $attempt->attempt_id, 'segment' => $idx])); ?>" target="_blank" rel="noopener" class="btn btn-sm btn-outline-primary">Question <?php echo e($idx + 1); ?></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php endif; ?>
            <video controls class="rounded border shadow-sm" style="max-width:100%; max-height:400px;" preload="metadata" id="reviewAttemptVideo">
                <source src="<?php echo e(route('lecturer.attempt.recording', $attempt->attempt_id)); ?>" type="video/webm">
                Your browser does not support the video tag.
            </video>
        </div>
        <?php else: ?>
        <p class="text-muted small mb-0">No proctoring recording available for this attempt.</p>
        <?php endif; ?>
        <?php if($attempt->behaviorLogs && $attempt->behaviorLogs->count() > 0): ?>
        <div class="mt-4">
            <h6 class="mb-2">Behaviour analysis (<?php echo e($attempt->behaviorLogs->count()); ?> events)</h6>
            <ul class="list-group list-group-flush small">
                <?php $__currentLoopData = $attempt->behaviorLogs->take(20); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="list-group-item d-flex justify-content-between align-items-center py-2">
                    <span><?php echo e($log->getEventDescription()); ?></span>
                    <span class="badge bg-<?php echo e($log->getSeverity() === 'high' ? 'danger' : ($log->getSeverity() === 'medium' ? 'warning text-dark' : 'secondary')); ?>"><?php echo e($log->timestamp ? $log->timestamp->format('H:i:s') : ''); ?></span>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
        <?php endif; ?>
    </div>
    <div class="card shadow-sm p-4">
        <h6 class="mb-3">Grading with AI assistance</h6>
        <form action="<?php echo e(route('lecturer.grade_quiz')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="attempt_id" value="<?php echo e($attempt->attempt_id); ?>">
            <div class="mb-3">
                <label class="form-label">Manual grade override</label>
                <input type="number" name="grade" class="form-control" step="0.01" min="0" value="<?php echo e(old('grade', $attempt->score)); ?>" placeholder="Enter score">
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="accept_ai_recommendation" value="1" id="acceptAi">
                    <label class="form-check-label" for="acceptAi">Accept AI Recommendation (auto-adjust grade based on severity)</label>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Notes</label>
                <textarea name="review_notes" class="form-control" rows="2" placeholder="e.g. Student warned for phone use. Grade reduced 10%."><?php echo e(old('review_notes', $attempt->review_notes)); ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Save Grade</button>
            <a href="<?php echo e(route('lecturer.risk_dashboard')); ?>" class="btn btn-outline-secondary">Back to Lecture Risk Analysis</a>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('inc.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\RPTP\Music\Apexia Academic Management System\resources\views/lecturer/review_attempt.blade.php ENDPATH**/ ?>