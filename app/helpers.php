<?php

if( !function_exists('generateIP') ) {
    function generateIP()
    {
        return mt_rand(0, 255) . "." . mt_rand(0, 255) . "." . mt_rand(0, 255) . "." . mt_rand(0, 255);
    }
}