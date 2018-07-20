<?php
if (!function_exists('ssdb')) {
    function ssdb()
    {
        return app('ssdb.simple');
    }
}