<?php

/**
 * STEP 24: Role definitions for Apexia AI Quiz Monitoring.
 */
return [
    'apexia' => [
        'student'  => ['name' => 'Student', 'dashboard' => 'student.dashboard'],
        'lecturer' => ['name' => 'Lecturer', 'dashboard' => 'lecturer.dashboard'],
        'developer'=> ['name' => 'Developer', 'dashboard' => 'developer.dashboard'],
    ],
    'all' => ['Student', 'Lecturer', 'Developer', 'Admin', 'Bursar', 'Librarian', 'Hostel Manager'],
];
