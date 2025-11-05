<?php

use BlakvGhost\PHPValidator\Validator;
use BlakvGhost\PHPValidator\ValidatorException;
use Wishlist\DebugUtils;
use Wishlist\ORM\User;

require_once '../vendor/autoload.php';

session_start();

$data = $_POST;

$rules = [
    'name' => 'required|alpha_num|min:2|max:25',
    'email' => 'required|email',
    'password' => 'required|min:4|max:30',
    'password_conformation' => 'required|same:password',
];

try {
    $validator = new Validator($data, $rules);

    if($validator->isValid()) {
        $user = new User($data['name'], $data['email'], $data['password']);
        if($user->save()) {
            $_SESSION['messages'] = ['register' => 'Registrierung war erfolgreich'];
            header('Location: index.php?a=login');
        }
        else {
            $_SESSION['errors'] = ['save' => 'Speichern nicht möglich'];
            $_SESSION['old'] = $_POST;
            header('Location: index.php?a=register');
        }
    }
    else {
        $_SESSION['errors'] = $validator->getErrors();
        $_SESSION['old'] = $_POST;
        header('Location: index.php?a=register');
    }
}
catch(ValidatorException $e) {
    $_SESSION['errors'] = ['validation' => $e->getMessage()];
    $_SESSION['old'] = $_POST;
    header('Location: index.php?a=register');
}