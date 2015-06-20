<?php
session_start();
$SECURE = true;

// Include required libraries
require __DIR__  .'/libs/globals.php';
require __DIR__  .'/libs/database.php';
require __DIR__  .'/libs/session.php';
require __DIR__  .'/libs/user.php';
require __DIR__  .'/libs/login.php';

// Include the code file
include __DIR__  .'/code/index.php';

// Include the ui file
include __DIR__ .'/ui/index.php';
?>