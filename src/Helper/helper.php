<?php

use ahmetbarut\Translation\Translation;

if(!function_exists('trans'))
{
    function trans($key)
    {
        return Translation::get($key);
    }
}