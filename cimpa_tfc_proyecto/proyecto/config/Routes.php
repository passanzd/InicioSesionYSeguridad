<?php
define('BASE_PATH', dirname(__DIR__));

define('BASE_URL', '/cimpa_tfc_proyecto/proyecto');

function asset($path)
{
    return BASE_URL . "/" . ltrim($path, "/");
}
