<?php

function combineAssoc($in, $key, $mode, $facs) {
    $names = [];
    $keys = [];
    $vals = [];
    $result = [];
    $output = [];
    $mult = 1;
    
    switch ($mode) {
        case "land":
            $mult = 1;
            break;
        case "cost":
            $mult = 1;
            break;
        case "input":
            $mult = 24;
            break;
        case "output":
            $mult = 24;
            break;
    }

    foreach ($in as $k => $res) {
        foreach  (explode(":", str_replace(",", ":", $res[$mode])) as $i => $v) {
            unset($idx);
            $idx = $i/2-0.5;
            
            if ($i % 2 == 0) {
                $names[$i/2] = $v;
            }
            else {
                $vals[$i/2-0.5] = (int)$v*(int)$mult*(int)$facs[$res['name']];

                if (array_key_exists($names[$idx], $result)) {
                    $result[$names[$idx]] += $vals[$idx];
                } else {
                    $result[$names[$idx]] = $vals[$idx];
                }
            }
        }
    }

    arsort($result, SORT_NUMERIC);
    

    foreach (array_keys($result) as $k => $v) {
        $keys[$v] = $v;
    }

    $output = array($result, $keys);

    return $output;
}

function makeAssoc($in, $key) {
    $result = [];
    $keys = [];
    $vals = [];
    $outassoc = [];
    $output = [];

    $prep = explode(",", str_replace(array("[", "]", '"', ":"), array("", "", "", ","), $in));

    foreach ($prep as $k => $v) {
        if ($k % 2 == 0) {
            $keys[] = $v;
        }
        else {
            $vals[] = $v;
        }
    }

    $outassoc = array_combine($keys, $vals);

    $output = array($outassoc, $keys);

    if ($key = 1) {
        return $output;
    }
    else {
        return $outassoc;
    }
}