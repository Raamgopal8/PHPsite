<?php
session_start();
echo "<pre>";
echo "Session User Data:\n";
print_r($_SESSION['user'] ?? 'No user in session');
echo "</pre>";
