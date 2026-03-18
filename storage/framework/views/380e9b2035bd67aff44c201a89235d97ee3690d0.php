<?php $__env->startSection('title', 'APEXIA | Lecture Risk Analysis'); ?>
<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="card shadow-sm p-4 mb-4">
        <h3 class="fw-bold m-0">Lecture Risk Analysis Module</h3>
        <p class="text-muted small mb-0">Quiz proctoring recordings are saved here. The system automatically analyses each recording and shows an accuracy (integrity) level based on AI behaviour detection (eyes, mouth, tab switch, devices, etc.). Accuracy is derived from proctoring behaviour (warnings and events) and the recording is stored for review.</p>
    </div>

    
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-light d-flex justify-content-between align-items-center flex-wrap gap-2">
            <h5 class="mb-0">Quiz attempts & proctoring recordings</h5>
            <span class="badge bg-primary">Auto-analysed</span>
        </div>
        <div class="card-body p-0">
            <?php if(isset($attempts) && $attempts->count() > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Quiz</th>
                            <th>Student</th>
                            <th>Started</th>
                            <th>Status</th>
                            <th>Warnings</th>
                            <th>Accuracy level</th>
                            <th>Recording</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $attempts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $hasRecording = !empty($a->recording_path) || (!empty($a->recording_segments) && is_array($a->recording_segments) && count($a->recording_segments) > 0);
                            $trustScore = (int) $a->trust_score;
                            $rating = $a->integrity_rating ?? '—';
                            $severity = $a->getSeverityLevel();
                        ?>
                        <tr>
                            <td><?php echo e($a->quiz->quiz_name ?? 'N/A'); ?></td>
                            <td><?php echo e($a->student ? ($a->student->full_name ?? $a->student->name_with_initials ?? 'N/A') : 'Guest'); ?></td>
                            <td><?php echo e($a->started_at ? $a->started_at->format('M j, Y g:i A') : '-'); ?></td>
                            <td><span class="badge bg-<?php echo e($a->status === 'completed' ? 'success' : ($a->status === 'terminated' ? 'danger' : 'secondary')); ?>"><?php echo e($a->status); ?></span></td>
                            <td><?php echo e($a->warning_count ?? 0); ?></td>
                            <td>
                                <span class="badge bg-<?php echo e($trustScore >= 85 ? 'success' : ($trustScore >= 60 ? 'warning text-dark' : 'danger')); ?>" title="Trust score <?php echo e($trustScore); ?>%">
                                    <?php echo e($trustScore); ?>% · <?php echo e($rating); ?>

                                </span>
                                <?php if($a->behaviorLogs && $a->behaviorLogs->count() > 0): ?>
                                <br><small class="text-muted"><?php echo e($a->behaviorLogs->count()); ?> event(s) logged</small>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($hasRecording): ?>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge bg-success"><i class="ti ti-video me-1"></i> Video saved</span>
                                    <small class="text-muted" title="<?php echo e($a->recording_path); ?>"><?php echo e(Str::limit(basename($a->recording_path), 28)); ?></small>
                                </div>
                                <a href="<?php echo e(route('lecturer.attempt.recording', $a->attempt_id)); ?>" target="_blank" rel="noopener" class="small text-primary mt-1 d-inline-block">Open video file</a>
                                <?php else: ?>
                                <span class="text-muted">No recording</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($hasRecording): ?>
                                <button type="button" class="btn btn-sm btn-success me-1" data-bs-toggle="modal" data-bs-target="#recordingModal" data-attempt-id="<?php echo e($a->attempt_id); ?>" data-student="<?php echo e($a->student ? ($a->student->full_name ?? $a->student->name_with_initials ?? '') : 'Guest'); ?>" data-quiz="<?php echo e($a->quiz->quiz_name ?? ''); ?>">
                                    <i class="ti ti-player-play"></i> Play here
                                </button>
                                <?php endif; ?>
                                <a href="<?php echo e(route('lecturer.review_attempt', $a->attempt_id)); ?>" class="btn btn-sm btn-outline-primary">Review / Grade</a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <?php else: ?>
            <p class="text-muted mb-0 p-4">No quiz attempts yet. Attempts will appear here after students complete your quizzes. Recordings are saved under this Lecture Risk Analysis module and accuracy is shown automatically.</p>
            <?php endif; ?>
        </div>
    </div>

    
    <?php if(isset($quizzes) && $quizzes->count() > 0): ?>
    <div class="card shadow-sm">
        <div class="card-header bg-light">
            <h5 class="mb-0">Your quizzes</h5>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <?php $__currentLoopData = $quizzes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $q): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <strong><?php echo e($q->quiz_name); ?></strong>
                    <a href="<?php echo e(route('lecturer.quiz.questions', $q->quiz_id)); ?>" class="btn btn-sm btn-outline-secondary">Questions</a>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
    <?php endif; ?>
</div>


<div class="modal fade" id="recordingModal" tabindex="-1" aria-labelledby="recordingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="recordingModalLabel">
                    <i class="ti ti-video me-2"></i> Proctoring recording
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-muted small mb-2" id="recordingModalMeta">—</p>
                <video id="recordingModalVideo" controls class="w-100 rounded border bg-black" style="max-height: 70vh;" preload="metadata">
                    <source id="recordingModalSource" src="" type="video/webm">
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById('recordingModal');
    if (modal) {
        modal.addEventListener('show.bs.modal', function(e) {
            var btn = e.relatedTarget;
            if (!btn) return;
            var attemptId = btn.getAttribute('data-attempt-id');
            var student = btn.getAttribute('data-student') || 'Student';
            var quiz = btn.getAttribute('data-quiz') || 'Quiz';
            document.getElementById('recordingModalMeta').textContent = quiz + ' · ' + student;
            var src = document.getElementById('recordingModalSource');
            var video = document.getElementById('recordingModalVideo');
            var url = '<?php echo e(url("/lecturer/attempt")); ?>/' + attemptId + '/recording';
            src.src = url;
            video.load();
            video.play().catch(function() {});
        });
        modal.addEventListener('hidden.bs.modal', function() {
            var video = document.getElementById('recordingModalVideo');
            if (video) { video.pause(); video.removeAttribute('src'); }
            var src = document.getElementById('recordingModalSource');
            if (src) src.removeAttribute('src');
        });
    }
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('inc.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\RPTP\Music\Apexia Academic Management System\resources\views/lecturer/risk_dashboard.blade.php ENDPATH**/ ?>