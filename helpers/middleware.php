<?php

function usersOnly($redirect = '/index.php')
{
    if (empty($_SESSION['id'])) {
        $_SESSION['message'] = 'You need to login first!';
        $_SESSION['type'] = 'danger';
        header('location: ' . BASE_URL . $redirect);
        exit();
    }
}

function adminOnly($redirect = '/index.php')
{
    if (empty($_SESSION['id']) || $_SESSION['role']!=='admin') {
        $_SESSION['message'] = 'You are not authorized!';
        $_SESSION['type'] = 'danger';
        header('location: ' . BASE_URL . $redirect);
        exit();
    }
}

function guestsOnly($redirect = '/index.php')
{
    if (isset($_SESSION['id'])) {
        header('location: ' . BASE_URL . $redirect);
        exit();
    }
}
