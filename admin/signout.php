<?php
@session_start();
unset($_SESSION['user_id']);
unset($_SESSION['user_name']);
unset($_SESSION['user_email']);
echo '<script>window.location="../login.html";</script>';
die();