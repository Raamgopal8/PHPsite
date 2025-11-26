<?php
namespace App\Helpers;

function auth() {
    return $_SESSION['user'] ?? null;
}

function isAdmin() {
    $u = auth();
    return $u && ($u['role'] ?? '') === 'admin';
}

function flash($key, $val = null) {
    if ($val === null) {
        $v = $_SESSION['flash'][$key] ?? null;
        unset($_SESSION['flash'][$key]);
        return $v;
    }
    $_SESSION['flash'][$key] = $val;
}
