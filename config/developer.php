<?php

/**
 * STEP 24: Developer-specific settings (impersonation, logs, backup).
 */
return [
    'impersonation' => ['allowed_roles' => ['student', 'lecturer']],
    'log_retention_days' => 90,
    'backup_enabled' => env('DEVELOPER_BACKUP_ENABLED', false),
];
