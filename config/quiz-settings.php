<?php

/**
 * STEP 24: Default quiz settings (Apexia).
 */
return [
    'defaults' => [
        'attempts_allowed' => 2,
        'passing_grade' => 40,
        'time_limit_minutes' => 60,
        'ai_monitoring_enabled' => true,
    ],
    'statuses' => ['draft', 'active', 'closed'],
];
