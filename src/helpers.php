<?php
if (!function_exists('ssdb')) {
    function ssdb(?string $name = null)
    {
        return app('ssdb.manager')->connection($name);
    }
}