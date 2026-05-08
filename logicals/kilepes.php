<?php
$data = array(
    'csn'   => $_SESSION['csn']   ?? '',
    'un'    => $_SESSION['un']    ?? '',
    'login' => $_SESSION['login'] ?? ''
);
session_unset();
session_destroy();
?>
