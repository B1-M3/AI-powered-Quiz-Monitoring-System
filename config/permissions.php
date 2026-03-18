<?php

return [
    'student' => [
        'quiz' => ['view', 'take', 'submit'],
        'attendance' => ['view'],
        'clearance' => ['view'],
    ],
    'lecturer' => [
        'quiz' => ['view', 'create', 'edit', 'grade'],
        'attendance' => ['view', 'mark'],
    ],
    'developer' => [
        'quiz' => ['view', 'create', 'edit', 'grade', 'manage_ai'],
        'system' => ['users', 'logs'],
    ],
];
