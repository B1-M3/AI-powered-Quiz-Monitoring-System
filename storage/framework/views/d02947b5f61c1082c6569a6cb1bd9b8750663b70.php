<?php $__env->startSection('title', 'APEXIA | Create Quiz'); ?>
<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="card shadow-sm p-4 mb-4">
        <h3 class="fw-bold m-0">Create Quiz</h3>
        <p class="text-muted small mb-0">Configure time limit, attempts, grading method, and AI monitoring (PDF workflow).</p>
    </div>
    <div class="card shadow-sm border-info mb-4">
        <div class="card-header bg-info text-white py-2">
            <h6 class="mb-0"><i class="ti ti-checklist me-1"></i> Workflow: 50 questions, 5 per student</h6>
        </div>
        <div class="card-body py-3 small">
            <p class="mb-2">To run a quiz where <strong>each student answers 5 randomly selected questions from a pool of 50</strong>:</p>
            <ol class="mb-0 ps-3">
                <li>Set <strong>Total questions in pool</strong> to <strong>50</strong> and <strong>Questions per attempt</strong> to <strong>5</strong> below.</li>
                <li>Save the quiz, then open <strong>Question pool</strong> (from your dashboard) and add 50 questions (use <strong>Bulk add</strong> or add one by one).</li>
                <li>Each child (student) will then get <strong>5 random questions</strong> out of the 50 when they attempt the quiz; the system records their face and analyzes behavior (eyes, mouth, tab switch, devices, etc.).</li>
            </ol>
        </div>
    </div>
    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="ti ti-alert-circle me-2"></i><?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php if($errors->any()): ?>
        <div class="alert alert-warning alert-dismissible fade show">
            <strong>Please fix the following:</strong>
            <ul class="mb-0 mt-1">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($err); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <div class="card shadow-sm p-4">
        <form action="<?php echo e(route('lecturer.quiz.store')); ?>" method="POST" id="quizCreateForm">
            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Quiz name <span class="text-danger">*</span></label>
                    <input type="text" name="quiz_name" class="form-control" value="<?php echo e(old('quiz_name')); ?>" required>
                    <?php $__errorArgs = ['quiz_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback d-block"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Course <span class="text-danger">*</span></label>
                    <select name="course_id" id="course_id" class="form-select" required>
                        <option value="">Select course</option>
                        <?php $__currentLoopData = $courses ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($c->course_id); ?>" <?php echo e(old('course_id', $autoCourseId ?? '') == $c->course_id ? 'selected' : ''); ?>><?php echo e($c->course_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['course_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback d-block"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Module <span class="text-danger">*</span></label>
                <select name="module_id" id="module_id" class="form-select" required data-initial-module="<?php echo e(old('module_id', $autoModuleId ?? '')); ?>" data-modules-url="<?php echo e(route('lecturer.quiz.modules')); ?>">
                    <option value="">Select course first</option>
                </select>
                <small class="text-muted d-block mt-1" id="module_loading" style="display:none;">Loading modules…</small>
                <small class="text-danger d-block mt-1" id="module_error" style="display:none;"></small>
                <?php $__errorArgs = ['module_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback d-block"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label class="form-label">Total questions in pool <span class="text-danger">*</span></label>
                    <input type="number" name="total_questions" class="form-control" min="1" value="<?php echo e(old('total_questions', 50)); ?>" required>
                    <small class="text-muted">e.g. 50 questions; add them after saving.</small>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Questions per attempt</label>
                    <input type="number" name="questions_per_attempt" class="form-control" min="1" placeholder="All" value="<?php echo e(old('questions_per_attempt', 5)); ?>">
                    <small class="text-muted">How many each student gets (e.g. 5 of 50). Leave empty for all.</small>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Time limit (minutes) <span class="text-danger">*</span></label>
                    <input type="number" name="time_limit_minutes" class="form-control" min="1" value="<?php echo e(old('time_limit_minutes', 60)); ?>" required>
                    <small class="text-muted">e.g. 20+ for 5 questions × 3 min + proctoring steps.</small>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Attempts allowed</label>
                    <input type="number" name="attempts_allowed" class="form-control" min="1" max="10" value="<?php echo e(old('attempts_allowed', 2)); ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Passing grade (%)</label>
                    <input type="number" name="passing_grade" class="form-control" min="0" max="100" step="0.01" value="<?php echo e(old('passing_grade')); ?>" placeholder="e.g. 40">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Grading method</label>
                    <select name="grading_method" class="form-select">
                        <option value="highest" <?php echo e(old('grading_method', 'highest') == 'highest' ? 'selected' : ''); ?>>Highest grade</option>
                        <option value="average" <?php echo e(old('grading_method') == 'average' ? 'selected' : ''); ?>>Average</option>
                        <option value="first" <?php echo e(old('grading_method') == 'first' ? 'selected' : ''); ?>>First attempt</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Start date <span class="text-danger">*</span></label>
                    <input type="datetime-local" name="start_date" class="form-control" value="<?php echo e(old('start_date')); ?>" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">End date <span class="text-danger">*</span></label>
                <input type="datetime-local" name="end_date" class="form-control <?php echo e($errors->has('end_date') ? 'is-invalid' : ''); ?>" value="<?php echo e(old('end_date')); ?>" required>
                <?php $__errorArgs = ['end_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback d-block"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <small class="text-muted">End date must be on or after start date.</small>
            </div>
            <div class="mb-3">
                <label class="form-label">Instructions</label>
                <textarea name="instructions" class="form-control" rows="2" placeholder="Optional instructions for students"><?php echo e(old('instructions')); ?></textarea>
            </div>
            <div class="card bg-light mb-3 p-3">
                <h6 class="mb-2">AI monitoring (proctoring)</h6>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="ai_monitoring_enabled" value="1" id="ai_monitoring" <?php echo e(old('ai_monitoring_enabled', true) ? 'checked' : ''); ?>>
                    <label class="form-check-label" for="ai_monitoring">Enable AI monitoring</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="face_detection" value="1" id="face_detection" <?php echo e(old('face_detection', true) ? 'checked' : ''); ?>>
                    <label class="form-check-label" for="face_detection">Face detection</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="gaze_tracking" value="1" id="gaze_tracking" <?php echo e(old('gaze_tracking', true) ? 'checked' : ''); ?>>
                    <label class="form-check-label" for="gaze_tracking">Gaze tracking</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="multi_person_detection" value="1" id="multi_person" <?php echo e(old('multi_person_detection', true) ? 'checked' : ''); ?>>
                    <label class="form-check-label" for="multi_person">Multi-person detection</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="tab_switch_detection" value="1" id="tab_switch" <?php echo e(old('tab_switch_detection', true) ? 'checked' : ''); ?>>
                    <label class="form-check-label" for="tab_switch">Tab switch detection</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="noise_detection" value="1" id="noise_detection" <?php echo e(old('noise_detection') ? 'checked' : ''); ?>>
                    <label class="form-check-label" for="noise_detection">Noise detection</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Save Quiz</button>
            <a href="<?php echo e(route('lecturer.dashboard')); ?>" class="btn btn-outline-secondary">Cancel</a>
        </form>
    </div>
</div>
<script <?php if(!empty($cspNonce)): ?> nonce="<?php echo e($cspNonce); ?>" <?php endif; ?>>
document.addEventListener('DOMContentLoaded', function() {
    var moduleSel = document.getElementById('module_id');
    var modulesUrl = moduleSel ? (moduleSel.getAttribute('data-modules-url') || '') : '';
    var autoModuleId = <?php echo e(json_encode($autoModuleId ?? null)); ?>;
    var autoCourseId = <?php echo e(json_encode($autoCourseId ?? null)); ?>;
    var courseSel = document.getElementById('course_id');
    var loadingEl = document.getElementById('module_loading');
    var errorEl = document.getElementById('module_error');
    if (!courseSel || !moduleSel || !modulesUrl) return;

    function clearModuleOptions() {
        while (moduleSel.options.length > 1) moduleSel.remove(1);
        moduleSel.value = '';
    }

    function setModuleOptions(modules, selectId) {
        clearModuleOptions();
        (modules || []).forEach(function(m) {
            var opt = document.createElement('option');
            opt.value = m.id;
            opt.textContent = m.name || ('Module ' + m.id);
            if (selectId && String(m.id) === String(selectId)) opt.selected = true;
            moduleSel.appendChild(opt);
        });
        if (!selectId && modules && modules.length > 0) moduleSel.selectedIndex = 1;
    }

    function loadModulesForCourse(courseId, thenSelectModuleId) {
        if (errorEl) errorEl.style.display = 'none';
        if (!courseId) {
            moduleSel.options[0].text = 'Select course first';
            clearModuleOptions();
            return;
        }
        moduleSel.options[0].text = 'Select module…';
        if (loadingEl) loadingEl.style.display = 'block';
        var url = modulesUrl + (modulesUrl.indexOf('?') >= 0 ? '&' : '?') + 'course_id=' + encodeURIComponent(courseId);
        fetch(url, {
            method: 'GET',
            headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
        }).then(function(r) {
            if (!r.ok) throw new Error('Request failed');
            return r.json();
        }).then(function(data) {
            var mods = data.modules || [];
            setModuleOptions(mods, thenSelectModuleId);
            if (errorEl) {
                if (mods.length === 0 && (data.message || '')) {
                    errorEl.textContent = data.message;
                    errorEl.style.display = 'block';
                } else {
                    errorEl.style.display = 'none';
                }
            }
        }).catch(function(err) {
            setModuleOptions([]);
            if (errorEl) {
                errorEl.textContent = 'Could not load modules. Please try again.';
                errorEl.style.display = 'block';
            }
        }).finally(function() {
            if (loadingEl) loadingEl.style.display = 'none';
        });
    }

    courseSel.addEventListener('change', function() {
        var cid = courseSel.value;
        var toSelect = (cid && autoCourseId && String(cid) === String(autoCourseId) && autoModuleId) ? autoModuleId : undefined;
        loadModulesForCourse(cid, toSelect);
    });

    if (courseSel.value) {
        var cid = courseSel.value;
        var initialModule = moduleSel.getAttribute('data-initial-module') || '';
        var toSelect = (cid && autoCourseId && String(cid) === String(autoCourseId) && autoModuleId) ? autoModuleId : (initialModule || undefined);
        loadModulesForCourse(cid, toSelect);
    }
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('inc.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\RPTP\Desktop\Apexia Academic Management System\resources\views/lecturer/quiz_create.blade.php ENDPATH**/ ?>