<?php

function validateisEmpty($nameTagTexted, $emptyTag = ["br","hr","img","input"]){
    $text = true;
    foreach($emptyTag as $value){
        $text = $text && ($nameTagTexted != $value);
    }
    return $text;
}

