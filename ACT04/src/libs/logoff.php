<?php
require __DIR__ . '/boostrap.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['confirm'] === 'yes') {
        session_destroy();
    }
    header('Location: /../../index.php');
    exit;
}