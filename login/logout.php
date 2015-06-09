<?php
session_start();
require "libs/session.php";
require "includes/functions.php";
session::destruct();
redirect_to("index.php");
?>