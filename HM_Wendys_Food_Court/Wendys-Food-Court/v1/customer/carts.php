<?
    session_start();
?>

<?php
    if(empty($_SESSION['email']) || $_SESSION['email'] == '') {
        header('Location: ../auth/login.php');
        return;
    }
?>

<?php
    $page = 'orders';
    include '../layouts/header.php';
    include '../layouts/navbar.php';
?>

