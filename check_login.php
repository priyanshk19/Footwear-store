<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo 'login_required';
} else {
    echo 'logged_in';
}
?>
