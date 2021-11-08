<?php

if( !function_exists('generateIp') ) {
    function generateIp()
    {
        return mt_rand(0, 255) . "." . mt_rand(0, 255) . "." . mt_rand(0, 255) . "." . mt_rand(0, 255);
    }
}