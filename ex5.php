<?php

declare(strict_types=1);

require_once __DIR__ . '/data.php';
require_once __DIR__ . '/helpers.php';


$rules = [

    'Submitted' => [
        'Under review'
    ],

    'Under review' => [
        'Approved',
        'Rejected'
    ],

    'Rejected' => [
        'Submitted'
    ],

    'Approved' => []
];


function can_move(
    string $from,
    string $to
): bool {

    global $rules;

    $allowed = $rules[$from] ?? [];

    return in_array($to, $allowed, true);
}


$tests = [

    ['Submitted', 'Under review'],

    ['Submitted', 'Approved'],

    ['Under review', 'Rejected'],

    ['Approved', 'Submitted'],

    ['Rejected', 'Submitted'],

    ['Closed', 'Submitted']
];


foreach ($tests as $test) {

    $from = $test[0];
    $to = $test[1];

    if (can_move($from, $to)) {

        echo "$from → $to: Allowed";

    } else {

        echo "$from → $to: Blocked";
    }

    echo "<br>";
}

function can_move_as(
    string $role,
    string $from,
    string $to
): bool {

    $roleTargets = [

        'officer' => [
            'Under review'
        ],

        'approver' => [
            'Approved',
            'Rejected'
        ],

        'requester' => [
            'Submitted'
        ]
    ];


    if (!isset($roleTargets[$role])) {
        return false;
    }


    if (!in_array($to, $roleTargets[$role], true)) {
        return false;
    }


    return can_move($from, $to);
}

echo can_move_as(
    'officer',
    'Under review',
    'Approved'
) ? 'true' : 'false';

echo "<br>";

echo can_move_as(
    'approver',
    'Under review',
    'Approved'
) ? 'true' : 'false';

echo "<br>";

echo can_move_as(
    'requester',
    'Rejected',
    'Submitted'
) ? 'true' : 'false';