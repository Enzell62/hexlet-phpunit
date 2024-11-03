<?php

namespace Hexlet\Phpunit\Utils;

function reverseString($string)
{
    return implode(array_reverse(str_split($string)));
}
