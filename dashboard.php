<?php
session_start();
$SECURE=true;

// all the sdk includes
include __DIR__ .'/libs/session.php';

// including the code files
include __DIR__ .'/code/sidebar.php';

// including the ui files
include __DIR__ .'/ui/header.html';
include __DIR__ .'/ui/sidebar.php';
?>


