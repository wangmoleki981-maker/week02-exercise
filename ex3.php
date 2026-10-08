<?php

declare(strict_types=1);

require_once __DIR__ . '/data.php';
require_once __DIR__ . '/helpers.php';


foreach ($requests as $r) {

    $reference = make_reference(
        $r['id'],
        $r['dzongkhag'],
        $r['submitted']
    );

    echo $reference;
    echo "<br>";
}