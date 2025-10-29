<?php
session_start();

$action = filter_input(INPUT_GET, 'a') ?? '';

$subTpl = match(strtolower($action)) {
    'login' => 'login.tpl.php',
    'register' => 'register.tpl.php',
    default => 'welcome.tpl.php'
};

include '../templates/standard.tpl.php';