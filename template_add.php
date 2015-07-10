<?php
session_start();
$SECURE=true;

// all the sdk includes
include __DIR__ .'/libs/session.php';
include __DIR__ .'/libs/database.php';
include __DIR__ .'/libs/user.php';

// including the code files
include __DIR__ .'/code/template_add.php';
include __DIR__ .'/code/sidebar.php';
include __DIR__ .'/code/header.php';

// including the ui files
include __DIR__ .'/ui/template_add.php';
?>