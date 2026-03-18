<?php $__env->startSection('title', 'APEXIA | Take Quiz'); ?>

<?php $__env->startSection('content'); ?>
<?php $hideCameraAndRecording = false; ?>
<div id="apexia-quiz-steps-wrapper" class="container-fluid position-relative" style="z-index: 1;">
    <?php if(!$student): ?>
        <div class="alert alert-info mb-3">
            <i class="ti ti-info-circle me-2"></i>Your account is not yet linked to a student record. You can still take this quiz; your attempt will be saved and you can view it under <strong>My Attempts</strong>. Contact administration to link your student record for full features.
        </div>
    <?php endif; ?>
    <div class="card shadow-sm p-4 mb-4">
        <h3 class="fw-bold m-0"><?php echo e($quiz->quiz_name); ?></h3>
        <?php if(empty($hideCameraAndRecording)): ?>
        <p class="text-muted small mb-1">AI proctored – face detection and behavior monitoring enabled.</p>
        <p class="text-muted small mb-0">
            <strong>5 questions</strong> (chosen at random from a pool of <strong>50</strong> – each student gets a different set).
            <strong><?php echo e(($quiz->questions && $quiz->questions->isNotEmpty() ? optional($quiz->questions->first())->time_limit_minutes : null) ?? 4); ?> minutes</strong>
            per question (maximum).
            <strong>20 minutes</strong> total quiz time.
            Session is recorded; after submission the recording is saved under <strong>Lecture Risk Analysis</strong> with an accuracy level.
        </p>
        <?php else: ?>
        <p class="text-muted small mb-0">
            <strong><?php echo e($quiz->questions_per_attempt ?? 5); ?> questions</strong> (chosen at random from the pool – each student gets a different set).
            <strong><?php echo e(($quiz->questions && $quiz->questions->isNotEmpty() ? optional($quiz->questions->first())->time_limit_minutes : null) ?? 4); ?> minutes</strong>
            per question (maximum) – <strong>20 minutes</strong> total.
        </p>
        <?php endif; ?>
    </div>

    <?php if(empty($hideCameraAndRecording)): ?>
    
    <div class="card shadow-sm border-warning mb-3">
        <div class="card-header bg-warning text-dark py-2">
            <h6 class="mb-0"><i class="ti ti-shield-check me-1"></i> AI monitoring (proctoring)</h6>
        </div>
        <div class="card-body py-3 small">
            <p class="mb-2">Enabled: <strong>face detection</strong>, <strong>gaze tracking</strong>, <strong>multi-person detection</strong>, <strong>tab switch detection</strong>, <strong>noise detection</strong>. Your <strong>eyes</strong> and <strong>mouth (lip movement)</strong> are analysed to detect:</p>
            <ul class="mb-2 ps-3">
                <li>Copying the question or reading from another source</li>
                <li>Looking at another browser tab or screen</li>
                <li>Another device (phone, tablet) nearby</li>
                <li>Looking at a book, notes or paper</li>
            </ul>
            <p class="mb-0">When cheating is detected, a <strong class="text-danger">red warning</strong> appears on top with the <strong>cheating type</strong>, count, time, and <strong>warning alert sound</strong>. The full session is <strong>recorded (15 min for 5 questions)</strong> and saved under <strong>Lecture Risk Analysis</strong> for the lecturer to review, with an <strong>accuracy level</strong>.</p>
        </div>
    </div>
    
    <div class="card shadow-sm border-success mb-3">
        <div class="card-header bg-success text-white py-2">
            <h6 class="mb-0"><i class="ti ti-camera me-1"></i> How it works</h6>
        </div>
        <div class="card-body py-3 small">
            <p class="mb-2">When you click the green <strong>Start quiz</strong> button below:</p>
            <ol class="mb-0 ps-3">
                <li class="mb-2">A message will ask: <strong>Is the quiz ready to start?</strong> — click <strong>Start quiz</strong> in the popup.</li>
                <li class="mb-2">Then: <strong>Are you ready to open the web camera (recording)?</strong> — click <strong>OK</strong> and your web camera will open. <strong>You will appear on screen</strong> (like in Identity verification).</li>
                <li class="mb-0">Complete the short <strong>Identity check</strong> (blink twice) and <strong>Room scan</strong> (10 sec). Then answer <strong>5 random questions</strong> (3 min each). At time-up you get a popup: <em>Need another minute or move to next question?</em> After all 5 questions, <strong>Submit</strong> or <strong>Cancel</strong>. Recording is saved under Lecture Risk Analysis with accuracy level.</li>
            </ol>
        </div>
    </div>
    
    <div class="card shadow-sm border-primary mb-4">
        <div class="card-header bg-primary text-white py-2">
            <h6 class="mb-0"><i class="ti ti-list-numbers me-1"></i> Full steps</h6>
        </div>
        <div class="card-body py-3 small">
            <ol class="mb-0 ps-3">
                <li class="mb-2"><strong>Is the quiz ready to start?</strong> → Click Start quiz in the popup.</li>
                <li class="mb-2"><strong>Are you ready to open the web camera (recording)?</strong> → Click OK; the webcam will open.</li>
                <li class="mb-2"><strong>Step 1: Camera & microphone</strong> → Allow camera & continue.</li>
                <li class="mb-2"><strong>Step 2: Identity</strong> → Look at the camera and blink twice slowly.</li>
                <li class="mb-2"><strong>Step 3: Room scan</strong> → Rotate your camera for 10 seconds.</li>
                <li class="mb-2"><strong>Step 4: Start quiz</strong> → Answer your questions. Face, eyes and behavior are monitored; recording is saved under Lecture Risk Analysis.</li>
            </ol>
        </div>
    </div>
    <div class="card shadow-sm p-3 mb-3">
        <div class="d-flex flex-wrap align-items-center gap-2 small">
            <span id="step-indicator-0" class="badge bg-primary">Start</span>
            <span class="text-muted">→</span>
            <span id="step-indicator-1" class="badge bg-secondary">1 Camera</span>
            <span class="text-muted">→</span>
            <span id="step-indicator-2" class="badge bg-secondary">2 Identity</span>
            <span class="text-muted">→</span>
            <span id="step-indicator-3" class="badge bg-secondary">3 Room scan</span>
            <span class="text-muted">→</span>
            <span id="step-indicator-4" class="badge bg-secondary">4 Start</span>
        </div>
    </div>
    <?php else: ?>
    <div class="card shadow-sm p-3 mb-3">
        <div class="d-flex flex-wrap align-items-center gap-2 small">
            <span id="step-indicator-0" class="badge bg-primary">Start</span>
        </div>
    </div>
    <?php endif; ?>

    
    <div id="apexia-step0" class="card shadow-sm p-4 mb-3 border-success">
        <?php if(empty($hideCameraAndRecording)): ?>
        <p class="small text-warning mb-2"><i class="ti ti-info-circle me-1"></i> Questions will not start until you complete: 1 Camera → 2 Identity → 3 Room scan → 4 Start quiz.</p>
        <h6 class="text-success mb-2">Start the flow</h6>
        <p class="small text-muted mb-3">Click the green button below. You will see: <strong>Is the quiz ready to start?</strong> → click Start quiz in the popup → then <strong>Are you ready to open the web camera (recording)?</strong> → click OK to turn on the camera.</p>
        <?php else: ?>
        <h6 class="text-success mb-2">Start the quiz</h6>
        <p class="small text-muted mb-3">
            Click the green button below to start. You will answer
            <strong><?php echo e($quiz->questions_per_attempt ?? 5); ?> random questions</strong>
            with about <strong>4 minutes</strong> per question and a
            <strong>20 minute</strong> total limit.
        </p>
        <?php endif; ?>
        
        <button type="button" class="btn btn-success btn-lg px-4" id="apexiaFirstStartQuizBtn"><i class="ti ti-player-play me-1"></i> Start quiz</button>
    </div>

    
    <div id="apexia-step1" class="card shadow-sm p-4 mb-3 border-primary" style="display:none;">
        <h6 class="mb-2">Step 1: Camera & microphone</h6>
        <p class="small text-muted mb-3">The quiz system needs access to your camera for identity verification and recording. Click <strong>Allow camera & continue</strong> below – your browser will ask for permission. After you allow, you will go to Identity verification.</p>
        <button type="button" class="btn btn-primary btn-lg" id="apexiaRequestCameraBtn">Allow camera & continue</button>
    </div>

    
    <div id="apexia-step2" class="card shadow-sm p-4 mb-3" style="display:none;">
        <h6 class="mb-2">Step 2: Identity verification</h6>
        <p class="small text-muted mb-2">Look at the camera and <strong>blink twice slowly</strong> for identity verification.</p>
        <div id="apexia-proctor-video" class="mb-3">
            <video id="apexiaWebcam" autoplay playsinline muted width="320" height="240" class="rounded border"></video>
        </div>
        <p id="apexia-identity-wait" class="small text-muted mb-2">Waiting for blinks...</p>
        <button type="button" class="btn btn-outline-primary btn-sm" id="apexiaIdentityDoneBtn" style="display:none;">I've blinked twice - continue</button>
    </div>

    
    <div id="apexia-step3" class="card shadow-sm p-4 mb-3" style="display:none;">
        <h6 class="mb-2">Step 3: Room scan</h6>
        <p class="small text-muted mb-2">Please slowly rotate your camera around your room (360°). Recording: <strong><span id="apexia-scan-countdown">10</span> seconds</strong>.</p>
        <p class="small text-muted mb-0">Rotate slowly…</p>
    </div>

    
    <div id="apexia-step4" class="card shadow-sm p-4 mb-3" style="display:none;">
        <?php if(empty($hideCameraAndRecording)): ?>
        <p class="small text-muted d-flex align-items-center mb-2">
            <span id="apexia-recording-dot" class="rounded-circle bg-danger me-2" style="width:10px;height:10px;display:none;animation:apexia-blink 1s infinite;"></span>
            Webcam active
        </p>
        <?php endif; ?>
        <p class="mb-2">
            Time limit: <strong>20</strong> min (for 5 questions). Attempts: <strong><?php echo e($quiz->attempts_allowed ?? 2); ?></strong>.
        </p>
        <a href="<?php echo e(route('student.quizzes')); ?>" class="btn btn-outline-secondary me-2">Back to list</a>
        <button type="button" class="btn btn-success btn-lg" id="startQuizBtn">Start quiz</button>
    </div>

    <div class="card shadow-sm p-4 border-light">
        <a href="<?php echo e(route('student.quizzes')); ?>" class="text-muted small"><i class="ti ti-arrow-left me-1"></i> Back to quizzes</a>
    </div>
</div>


<div id="apexia-quiz-in-progress" class="apexia-quiz-fullscreen position-fixed top-0 start-0 w-100 h-100 d-flex flex-column overflow-hidden <?php echo e($hideCameraAndRecording ? 'apexia-no-camera bg-light' : 'apexia-quiz-bg'); ?>" style="display:none; z-index: 9998;">
    
    <div class="apexia-quiz-topbar d-flex justify-content-between align-items-center flex-wrap gap-2 px-3 py-2 bg-dark bg-opacity-85 text-white border-bottom border-secondary position-relative z-2">
        <?php if(empty($hideCameraAndRecording)): ?>
        <span class="d-flex align-items-center gap-2" id="apexia-recording-label">
            <span id="apexia-quiz-rec-dot" class="rounded-circle bg-danger" style="width:10px;height:10px;animation:apexia-blink 1s infinite;"></span>
            <strong>Recording</strong>
            <span id="apexia-session-info" class="small opacity-90">5 questions · 4 min each · 20 min total</span>
        </span>
        <?php endif; ?>
        <span class="d-flex align-items-center gap-2">
            <span class="small">Question <span id="apexia-q-num-hdr">1</span>/<span id="apexia-q-total-hdr">5</span></span>
            <span id="apexia-quiz-timer" class="badge bg-warning text-dark">3:00</span>
        </span>
    </div>
    <?php if(empty($hideCameraAndRecording)): ?>
    <div id="apexia-quiz-cam-wrap" class="apexia-cam-wrap position-relative flex-grow-1 min-h-0 d-flex align-items-center justify-content-center apexia-quiz-bg">
        <video id="apexia-quiz-live-cam" class="apexia-quiz-live-cam" autoplay playsinline muted style="position:absolute; inset:0; width:100%; height:100%; min-height:280px; object-fit:cover; background:#1e2433; visibility:visible;"></video>
        <div id="apexia-cam-placeholder" class="apexia-cam-placeholder position-absolute text-center px-4" style="pointer-events:none; top:28%; left:50%; transform:translate(-50%,0); z-index:10; font-size:0.95rem; color:rgba(255,255,255,0.85);">Proctoring camera feed will appear here.<br><span class="text-white-50" style="font-size:0.85rem;">If the feed is not visible, click <strong>Enable camera</strong> below.</span></div>
        <canvas id="apexia-face-overlay" class="apexia-face-overlay position-absolute top-0 start-0 w-100 h-100" aria-hidden="true" style="pointer-events:none;"></canvas>
        <div class="apexia-cam-you-label position-absolute bottom-0 start-0 m-2 px-2 py-1 rounded small text-white">You <span class="opacity-75">(live)</span></div>
        <div class="apexia-cam-label position-absolute bottom-0 start-0 end-0 small text-white text-center py-2 m-0">Face · Eyes · Mouth monitored</div>
        <div id="apexia-overlay-violation" class="apexia-overlay-violation position-absolute top-0 start-0 end-0 text-center text-white small fw-bold py-1 d-none"></div>
        <button type="button" id="apexia-show-camera-btn" class="apexia-enable-camera-btn position-absolute border-0 rounded shadow-sm" style="top:50%; left:50%; transform:translate(-50%,-50%); padding:14px 32px; font-size:1rem; font-weight:600; z-index:50; pointer-events:auto; cursor:pointer; background:rgba(255,255,255,0.12); color:#fff; border:1px solid rgba(255,255,255,0.3);"><i class="ti ti-video me-2" aria-hidden="true"></i>Enable camera</button>
    </div>
    <?php endif; ?>
    
    <div class="apexia-quiz-question position-absolute bottom-0 start-0 end-0 z-2 overflow-auto apexia-quiz-panel">
        <div class="p-4 bg-light bg-opacity-98 shadow-lg rounded-top-3 border border-bottom-0 border-secondary">
            <p class="text-muted small mb-2">Question <span id="apexia-q-num">1</span> of <span id="apexia-q-total">5</span></p>
            <h4 id="apexia-q-text" class="mb-4 text-dark"></h4>
            <div id="apexia-q-options" class="mb-4"></div>
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-primary" id="apexia-quiz-next">Next question</button>
                <button type="button" class="btn btn-success" id="apexia-quiz-submit" style="display:none;">Submit quiz</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="apexiaSubmitConfirmModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Submit quiz?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure? You cannot change answers after submission.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" id="apexiaSubmitConfirmBtn">Submit</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="apexiaReadyToStartModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Is the quiz ready to start?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-2"><strong>Is the quiz ready to start?</strong></p>
                <?php if(empty($hideCameraAndRecording)): ?>
                <p class="mb-0">When you are ready, click the <strong>Start quiz</strong> button below. You will then see a message asking: &ldquo;Are you ready to open the web camera (recording)?&rdquo; — click OK to turn on the camera and appear on screen.</p>
                <?php else: ?>
                <p class="mb-0">When you are ready, click the <strong>Start quiz</strong> button below to begin the quiz.</p>
                <?php endif; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary btn-lg" id="apexiaReadyStartQuizBtn">Start quiz</button>
            </div>
        </div>
    </div>
</div>

<?php if(empty($hideCameraAndRecording)): ?>

<div class="modal fade" id="apexiaWebcamReadyModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Web camera (recording)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-2"><strong>Are you ready to open the web camera (recording)?</strong></p>
                <p class="mb-0">When you click OK, the camera will turn on and you (the student taking the quiz) will appear on the screen. You must keep the camera on and look at it while answering. When the first question is shown, the system will start analyzing your behavior through the web camera. The session will be recorded for the lecturer.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success btn-lg" id="apexiaWebcamOkBtn">OK</button>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>


<div class="modal fade" id="apexiaStartQuizModal" tabindex="-1" aria-labelledby="apexiaStartQuizModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="apexiaStartQuizModalLabel">Start quiz</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>You are about to start <strong>"<?php echo e($quiz->quiz_name); ?>"</strong>.</p>
                <p class="small mb-2">
                    <strong><?php echo e($quiz->questions_per_attempt ?? 5); ?> questions</strong>
                    (chosen at random from the pool of <?php echo e($quiz->questions ? $quiz->questions->count() : 50); ?> – each student gets a different set).
                    <strong><?php echo e(($quiz->questions && $quiz->questions->isNotEmpty() ? optional($quiz->questions->first())->time_limit_minutes : null) ?? 4); ?> minutes</strong>
                    per question ·
                    <strong>20 minutes</strong> total.
                </p>
                <?php if(empty($hideCameraAndRecording)): ?>
                <p class="small mb-2">Your <strong>face will be shown on screen like a Zoom meeting</strong> (full screen), with the quiz question in a panel. The system detects cheating from your <strong>eyes, face and mouth</strong> and shows a warning with an alert sound.</p>
                <ul class="small mb-0">
                    <li><strong>AI monitoring:</strong> face detection, gaze tracking, multi-person, tab switch, noise detection</li>
                    <li>Do not switch tabs or look away; no phones or extra people</li>
                    <li>Full session (15 min) is recorded for the lecturer</li>
                </ul>
                <?php endif; ?>
                <p class="mb-0 mt-2">Are you sure you want to start?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="apexiaStartQuizConfirm">Start Quiz</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="apexiaCompleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Quiz completed</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <p class="mb-2">Thank you! Your quiz has been submitted successfully.</p>
                <p class="small mb-2">Do you want to review your answers and see your attempt summary?</p>
                <?php if(empty($hideCameraAndRecording)): ?>
                <p class="small text-muted mb-2">Your recording is saved under <strong>Lecture Risk Analysis</strong> for your lecturer.</p>
                <div id="apexia-behavior-summary" class="small text-muted mt-2 p-2 bg-light rounded text-start" style="display:none;">
                    <strong>My behavior summary:</strong> <span id="apexia-behavior-summary-text">Your session had 0 low-severity warnings. No violations recorded.</span>
                </div>
                <?php endif; ?>
            </div>
            <div class="modal-footer justify-content-center">
                <a href="<?php echo e(route('student.quizzes')); ?>" class="btn btn-outline-secondary">Back to course</a>
                <a href="<?php echo e(route('student.attempts')); ?>" class="btn btn-primary">View summary</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="apexiaTimeUpModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title">Time is over for this question</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-2">You have reached the time limit (3 minutes) for this question.</p>
                <p class="small text-muted mb-0">
                    Do you need <strong>another minute</strong> for this question, or should you <strong>move on to the next question</strong>?
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" id="apexiaTimeUpNextBtn" data-bs-dismiss="modal">
                    Move to next question
                </button>
                <button type="button" class="btn btn-primary" id="apexiaTimeUpExtraBtn" data-bs-dismiss="modal">
                    Give me 1 more minute
                </button>
            </div>
        </div>
    </div>
</div>
<style>
@keyframes apexia-blink{0%,100%{opacity:1}50%{opacity:0.4}}
.apexia-warning-popup{position:fixed;top:0;left:0;right:0;z-index:10000;display:flex;justify-content:center;padding:16px;animation:apexia-slideDown 0.3s ease;}
@keyframes apexia-slideDown{from{transform:translateY(-100%);opacity:0}to{transform:translateY(0);opacity:1}}
.apexia-warning-box{background:#8B0000;color:#fff;border:3px solid #ff4444;border-radius:8px;box-shadow:0 8px 32px rgba(0,0,0,0.5);min-width:340px;max-width:480px;overflow:hidden;}
.apexia-warning-box-cheating{background:#b91c1c;border-color:#ef4444;box-shadow:0 8px 32px rgba(220,38,38,0.5);}
.apexia-warning-header{font-weight:bold;font-size:1rem;padding:12px 16px;background:rgba(0,0,0,0.3);border-bottom:1px solid rgba(255,255,255,0.2);}
.apexia-warning-body{padding:16px;}
.apexia-warning-msg{margin:0 0 8px;font-size:0.95rem;line-height:1.4;}
.apexia-warning-sub{margin:0 0 8px;font-size:0.85rem;opacity:0.95;}
.apexia-warning-count{margin:0 0 12px;font-size:0.9rem;font-weight:bold;}
.apexia-warning-actions{display:flex;align-items:center;gap:12px;}
.apexia-warning-ok{background:#fff;color:#8B0000;border:none;padding:10px 24px;border-radius:6px;font-weight:bold;cursor:pointer;}
.apexia-warning-ok:hover{background:#f0f0f0;}
.apexia-warning-sound{font-size:1.2rem;}
.apexia-critical-box{background:#5c0000;border-color:#ff6666;}
.apexia-warning-restore{background:#ff4444;color:#fff;border:none;padding:12px 20px;border-radius:6px;font-weight:bold;cursor:pointer;}
.apexia-warning-restore:hover{background:#cc3333;}
/* Zoom-style: student on full screen, quiz panel overlay at bottom */
.apexia-quiz-fullscreen{min-height:0;}
.apexia-cam-wrap{position:relative;width:100%;height:100%;min-height:280px;z-index:1;}
.apexia-quiz-bg{background:#1e2433;}
.apexia-quiz-live-cam{width:100%;height:100%;min-height:280px;object-fit:cover;background:#1e2433;display:block;position:absolute;inset:0;z-index:2;}
.apexia-cam-placeholder{pointer-events:none;z-index:1;}
.apexia-cam-wrap.apexia-live .apexia-cam-placeholder{display:none;}
.apexia-face-overlay{pointer-events:none;left:0;top:0;z-index:3;background:transparent;}
.apexia-cam-you-label{background:rgba(0,0,0,0.6);font-size:0.8rem;z-index:2;}
.apexia-cam-label{background:linear-gradient(transparent,rgba(0,0,0,0.8));font-size:0.75rem;}
.apexia-overlay-violation{background:rgba(180,0,0,0.85);z-index:3;}
.apexia-quiz-panel{max-height:48vh;border-radius:1rem 1rem 0 0;}
.apexia-no-camera .apexia-quiz-panel{max-height:85vh;}
.apexia-quiz-question .form-check-label,.apexia-quiz-question .form-label{user-select:text;}
.apexia-cam-wrap.apexia-warning-flash{box-shadow:inset 0 0 0 4px #ff4444;animation:apexia-redflash 0.5s ease;}
@keyframes apexia-redflash{0%,100%{opacity:1}50%{opacity:0.9}}
@media (max-width: 767px){
.apexia-quiz-panel{max-height:55vh;}
}
/* Proctoring: professional Enable camera button (university exam style) */
.apexia-enable-camera-btn{cursor:pointer;transition:background .2s, border-color .2s, color .2s;}
.apexia-enable-camera-btn:hover{background:rgba(255,255,255,0.22) !important;border-color:rgba(255,255,255,0.5) !important;color:#fff !important;}
.apexia-enable-camera-btn:focus{outline:0;box-shadow:0 0 0 2px rgba(255,255,255,0.4);}
/* Ensure modals appear above the fullscreen quiz panel (z-index 9998) */
.modal{z-index:10001 !important;}
.modal-backdrop{z-index:10000 !important;}
</style>
<?php $__env->stopSection(); ?>

<?php
    $questionsForJs = $quiz->questions ? $quiz->questions->map(function($q) {
        return [
            'id' => $q->question_id,
            'text' => $q->question_text,
            'time_limit_minutes' => (int) ($q->time_limit_minutes ?? 3),
            'options' => $q->options ? $q->options->map(function($o) { return ['id' => $o->option_id, 'text' => $o->option_text]; })->values()->all() : [],
        ];
    })->values()->all() : [];
    $quizConfig = [
        'quizId' => (int) ($quiz->quiz_id ?? 0),
        'submitUrl' => route('student.quiz.submit', ['quizId' => $quiz->quiz_id ?? 0]),
        'startAttemptUrl' => route('student.quiz.start_attempt', ['quizId' => $quiz->quiz_id ?? 0]),
        'noCameraNoRecording' => false,
    ];
?>
<?php $__env->startSection('scripts'); ?>
<script <?php if(!empty($cspNonce)): ?> nonce="<?php echo e($cspNonce); ?>" <?php endif; ?> type="application/json" id="apexia-quiz-questions"><?php echo json_encode($questionsForJs, 15, 512) ?></script>
<script <?php if(!empty($cspNonce)): ?> nonce="<?php echo e($cspNonce); ?>" <?php endif; ?> type="application/json" id="apexia-quiz-config"><?php echo json_encode($quizConfig, 15, 512) ?></script>

<script <?php if(!empty($cspNonce)): ?> nonce="<?php echo e($cspNonce); ?>" <?php endif; ?> src="<?php echo e(asset('js/student/quiz-take-steps.js')); ?>?v=27"></script>
<script <?php if(!empty($cspNonce)): ?> nonce="<?php echo e($cspNonce); ?>" <?php endif; ?> src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@4.10.0/dist/tf.min.js" defer></script>
<script <?php if(!empty($cspNonce)): ?> nonce="<?php echo e($cspNonce); ?>" <?php endif; ?> src="https://cdn.jsdelivr.net/npm/@tensorflow-models/blazeface@0.0.7/dist/blazeface.min.js" defer></script>
<script <?php if(!empty($cspNonce)): ?> nonce="<?php echo e($cspNonce); ?>" <?php endif; ?> src="https://cdn.jsdelivr.net/npm/@tensorflow-models/coco-ssd@2.2.2/dist/coco-ssd.min.js" defer></script>
<script <?php if(!empty($cspNonce)): ?> nonce="<?php echo e($cspNonce); ?>" <?php endif; ?> src="<?php echo e(asset('js/tensorflow/face-detection.js')); ?>" defer></script>
<script <?php if(!empty($cspNonce)): ?> nonce="<?php echo e($cspNonce); ?>" <?php endif; ?> src="<?php echo e(asset('js/tensorflow/object-detection.js')); ?>" defer></script>
<script <?php if(!empty($cspNonce)): ?> nonce="<?php echo e($cspNonce); ?>" <?php endif; ?> src="<?php echo e(asset('js/tensorflow/gaze-tracking.js')); ?>" defer></script>
<script <?php if(!empty($cspNonce)): ?> nonce="<?php echo e($cspNonce); ?>" <?php endif; ?> src="<?php echo e(asset('js/tensorflow/lip-movement.js')); ?>" defer></script>
<script <?php if(!empty($cspNonce)): ?> nonce="<?php echo e($cspNonce); ?>" <?php endif; ?> src="<?php echo e(asset('js/quiz/media-recorder.js')); ?>" defer></script>
<script <?php if(!empty($cspNonce)): ?> nonce="<?php echo e($cspNonce); ?>" <?php endif; ?> src="<?php echo e(asset('js/quiz/warning-system.js')); ?>" defer></script>
<script <?php if(!empty($cspNonce)): ?> nonce="<?php echo e($cspNonce); ?>" <?php endif; ?> src="<?php echo e(asset('js/quiz/proctor.js')); ?>" defer></script>
<script <?php if(!empty($cspNonce)): ?> nonce="<?php echo e($cspNonce); ?>" <?php endif; ?> src="<?php echo e(asset('js/student/quiz-taker.js')); ?>" defer></script>
<script <?php if(!empty($cspNonce)): ?> nonce="<?php echo e($cspNonce); ?>" <?php endif; ?> src="<?php echo e(asset('js/quiz/face-overlay.js')); ?>" defer></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('inc.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\RPTP\Music\Apexia Academic Management System\resources\views/student/quiz_take.blade.php ENDPATH**/ ?>