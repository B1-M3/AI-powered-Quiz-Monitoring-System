<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title> APEXIA | Sign In</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo e(asset('images/logos/apexia.png')); ?>">
    <link rel="shortcut icon" type="image/png" href="<?php echo e(asset('images/logos/apexia.png')); ?>">

    <!-- CSS -->
    <link nonce="<?php echo e($cspNonce); ?>" href="<?php echo e(asset('css/styles.min.css')); ?>" rel="stylesheet">
    <link nonce="<?php echo e($cspNonce); ?>" href="<?php echo e(asset('css/login.css')); ?>" rel="stylesheet">
    <link nonce="<?php echo e($cspNonce); ?>" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- JS -->
    <script nonce="<?php echo e($cspNonce); ?>" src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
    <script nonce="<?php echo e($cspNonce); ?>" src="<?php echo e(asset('libs/bootstrap/dist/js/bootstrap.bundle.min.js')); ?>"></script>
    <script nonce="<?php echo e($cspNonce); ?>" src="<?php echo e(asset('js/login.js')); ?>"></script>

        <!-- Video Background CSS -->
    <style nonce="<?php echo e($cspNonce); ?>">
        /* Video background for login page */
        body {
            background: none !important;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        /* Video background container */
        #video-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        /* Video styling */
        #bg-video {
            position: absolute;
            top: 50%;
            left: 50%;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            transform: translate(-50%, -50%);
            object-fit: cover;
            filter: brightness(0.7);
        }

        /* Fallback for mobile */
        @media (max-width: 768px) {
            #video-background {
                display: none;
            }
            body {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            }
        }

        /* Make login card more visible */
        .card {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        /* Override radial-gradient to work with video */
        .radial-gradient {
            background: transparent !important;
        }
    </style>

    <!-- JS -->
    <script nonce="<?php echo e($cspNonce); ?>" src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
    <script nonce="<?php echo e($cspNonce); ?>" src="<?php echo e(asset('libs/bootstrap/dist/js/bootstrap.bundle.min.js')); ?>"></script>
    <script nonce="<?php echo e($cspNonce); ?>" src="<?php echo e(asset('js/login.js')); ?>"></script>
</head>

<body>
    <!-- Video Background -->
    <div id="video-background">
        <video autoplay muted loop playsinline id="bg-video">
            <source src="<?php echo e(asset('video/backgrounds/apexia.mp4')); ?>" type="video/mp4">
           
        </video>
    </div>

    <div class="page-wrapper" id="main-wrapper">

        <div class="position-relative radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="row justify-content-center w-100">
                <div class="col-md-8 col-lg-6 col-xxl-3">

                    <div class="card mb-0">
                        <div class="card-body">

                            <a href="./" class="text-center d-block py-3 w-100">
                                <img src="<?php echo e(asset('images/logos/apexia.png')); ?>" alt="apexia" class="img-fluid" loading="lazy">
                            </a>

                            <?php if(session('error')): ?>
                                <div class="alert alert-warning"><?php echo e(session('error')); ?></div>
                            <?php endif; ?>
                            <?php if(($errors ?? collect())->any()): ?>
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><?php echo e($error); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>

                            <form id="loginForm" method="POST" action="<?php echo e(route('login.authenticate')); ?>" class="pt-3">
                                <?php echo csrf_field(); ?>

                                <div class="form-group mb-3">
                                    <label for="email">Username</label>
                                    <input type="email"
                                        id="email"
                                        name="email"
                                        class="form-control form-control-lg <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        placeholder="Enter your username"
                                        value="<?php echo e(old('email')); ?>"
                                        autocomplete="email"
                                        required>

                                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="error-message"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="password">Password</label>

                                    <div class="input-group">
                                        <input type="password"
                                               id="password"
                                               name="password"
                                               class="form-control form-control-lg <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                               placeholder="Enter your password"
                                               autocomplete="current-password"
                                               required>

                                        <span class="input-group-text btn-password" id="togglePassword">
                                            <i id="togglePasswordIcon" class="bi bi-eye"></i>
                                        </span>
                                    </div>

                                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="error-message"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <button type="submit" class="btn btn-primary w-100 py-2 fs-4 rounded-2">
                                    Sign In
                                </button>

                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <footer class="footer bg-dark text-light text-center py-3">
        <p class="mb-0">&copy; <span id="currentYear"></span> Apexia. All rights reserved.</p>
    </footer>
</body>

</html>
<?php /**PATH C:\Users\RPTP\Desktop\Apexia Academic Management System\resources\views/login.blade.php ENDPATH**/ ?>