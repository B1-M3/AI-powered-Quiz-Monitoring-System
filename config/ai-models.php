<?php

/**
 * STEP 24: AI model settings for proctoring (face, gaze, etc.).
 */
return [
    'enabled' => env('AI_PROCTORING_ENABLED', true),
    'models' => [
        'face_detection' => ['enabled' => true, 'threshold' => 0.8],
        'gaze_tracking'  => ['enabled' => true, 'threshold' => 0.7],
        'multi_person'   => ['enabled' => true],
        'tab_switch'     => ['enabled' => true],
        'noise_detection'=> ['enabled' => true],
    ],
    'risk_levels' => ['low' => 0.3, 'medium' => 0.6, 'high' => 0.9],
];
