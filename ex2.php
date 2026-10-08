<?php

declare(strict_types=1);

require_once __DIR__ . '/data.php';
require_once __DIR__ . '/helpers.php';

$counts = [];


// Count pending requests

foreach ($requests as $r) {

    if (
        $r['status'] === 'Submitted' ||
        $r['status'] === 'Under review'
    ) {

        $dzongkhag = strtolower(trim($r['dzongkhag']));

        if (!isset($counts[$dzongkhag])) {
            $counts[$dzongkhag] = 0;
        }

        $counts[$dzongkhag]++;
    }
}


// Find highest count

$highest = 0;

foreach ($counts as $count) {

    if ($count > $highest) {
        $highest = $count;
    }
}


// Print winner

foreach ($counts as $dzongkhag => $count) {

    if ($count === $highest) {

        echo "Busiest: ";
        echo ucfirst($dzongkhag);
        echo " ($count pending)";
        echo "<br>";
    }
}