
<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Quiz Monitoring System Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration settings for the AI-Powered Quiz Monitoring System.
    |
    */
    
    // AI Monitoring Settings
    'ai_monitoring' => [
        'enabled' => env('QUIZ_AI_MONITORING', true),
        'face_detection_threshold' => 0.5,
        'gaze_detection_threshold' => 0.3,
        'warning_threshold' => 3,
        'max_warnings' => 5,
    ],
    
    // Video Recording Settings
    'recording' => [
        'enabled' => env('QUIZ_RECORDING_ENABLED', true),
        'storage_disk' => 'private',
        'retention_days' => 90,
        'max_file_size_mb' => 500,
        'quality' => 'medium', // low, medium, high
    ],
    
    // WebSocket Settings
    'websocket' => [
        'enabled' => env('QUIZ_WEBSOCKET_ENABLED', true),
        'host' => env('WEBSOCKET_HOST', 'localhost'),
        'port' => env('WEBSOCKET_PORT', 6001),
        'path' => env('WEBSOCKET_PATH', '/quiz-monitoring'),
    ],
    
    // Security Settings
    'security' => [
        'tab_switch_detection' => true,
        'right_click_disable' => true,
        'keyboard_shortcut_block' => true,
        'print_screen_block' => true,
        'developer_tools_block' => false,
    ],
    
    // Timing Settings
    'timing' => [
        // Default per-question time limit (3–4 minutes range requested; use 4 minutes as default)
        'question_time_limit_default' => 240, // seconds (4 minutes per question)
        // Default total quiz time limit – 5 questions × 4 minutes = 20 minutes
        'quiz_time_limit_default' => 1200, // seconds (20 minutes total)
        'warning_cooldown' => 30, // seconds between warnings
        'auto_submit_delay' => 60, // seconds after time limit
    ],
    
    // Storage Paths
    'paths' => [
        'recordings' => 'quiz-recordings',
        'thumbnails' => 'quiz-thumbnails',
        'screenshots' => 'quiz-screenshots',
        'logs' => 'quiz-logs',
    ],
    
    // Notifications
    'notifications' => [
        'email_instructor_on_cheating' => true,
        'email_student_on_warning' => true,
        'sms_notifications' => false,
        'push_notifications' => true,
    ],
    
    // Integration Settings
    'integrations' => [
        'tensorflow_js_version' => '3.11.0',
        'mediapipe_version' => '0.4.1630009614',
        'enable_browser_sniffing' => true,
        'compatibility_mode' => false,
    ],
    
    // Debug Settings
    'debug' => [
        'log_detections' => env('QUIZ_DEBUG_LOG', false),
        'save_raw_video' => env('QUIZ_SAVE_RAW_VIDEO', false),
        'simulate_cheating' => env('QUIZ_SIMULATE_CHEATING', false),
        'verbose_logging' => env('QUIZ_VERBOSE_LOGGING', false),
    ],
];