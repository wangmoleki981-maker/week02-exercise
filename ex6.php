<?php

declare(strict_types=1);

require_once __DIR__ . '/data.php';
require_once __DIR__ . '/helpers.php';


function count_pending(array $requests): int
{
    $total = 0;


    for (
        $i = 0;
        $i < count($requests);
        $i++
    ) {

        $status = $requests[$i]['status'];


        if (
            $status === 'Submitted' ||
            $status === 'Under review'
        ) {

            $total++;
        }
    }


    return $total;
}


echo count_pending($requests);