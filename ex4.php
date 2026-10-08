<?php

declare(strict_types=1);

require_once __DIR__ . '/data.php';
require_once __DIR__ . '/helpers.php';


$today = '2026-10-07';

$overdue = 0;
$followUp = 0;
$onTime = 0;


foreach ($requests as $r) {

    if (
        $r['status'] !== 'Submitted' &&
        $r['status'] !== 'Under review'
    ) {
        continue;
    }


    $days = intdiv(
        strtotime($today) - strtotime($r['submitted']),
        86400
    );


    $band = wait_band($days);


    $name = trim($r['first']) . ' ' . ucfirst($r['last']);

    echo "#{$r['id']} $name — $days days — $band";
    echo "<br>";


    if ($band === 'Overdue') {
        $overdue++;
    }

    elseif ($band === 'Follow up') {
        $followUp++;
    }

    elseif ($band === 'On time') {
        $onTime++;
    }
}


echo "$overdue overdue · ";
echo "$followUp follow up · ";
echo "$onTime on time";