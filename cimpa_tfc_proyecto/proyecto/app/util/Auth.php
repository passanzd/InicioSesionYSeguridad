<?php


function requireAuth(): void
{
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header("Location: /cimpa_tfc_proyecto/proyecto/public/");
        exit;
    }
}
