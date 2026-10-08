<?php

function make_reference(
    int $id,
    string $dzongkhag,
    string $submitted
): string {
    $place = strtoupper(substr(trim($dzongkhag), 0, 3));
    $year = substr($submitted, 0, 4);
    $number = str_pad((string)$id, 4, '0', STR_PAD_LEFT);

    return "$place-$year-$number";
}


function wait_band(int $days): string
{
    if ($days < 0) {
        return 'Check date';
    }

    if ($days <= 7) {
        return 'On time';
    }

    if ($days <= 14) {
        return 'Follow up';
    }

    return 'Overdue';
}


function is_valid_cid(string $cid): bool
{
    return strlen($cid) === 11 && ctype_digit($cid);
}