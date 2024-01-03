<?php


use Core\Authenticator;
use HTTP\Forms\LoginForm;



$attributes = [
    'email' => $_POST['email'],
    'password' => $_POST['password']
];

// validate form inputs
$form = LoginForm::validate($attributes);

// getting to this point means no exceptiion has been thrown

// authenticate user 
$auth = new Authenticator();

// match credentials
$signedIn = $auth->attempt(
    $attributes['email'],
    $attributes['password']
);

if (!$signedIn) {
    // update errors if login fails
    $form->addError(
        'email',
        'No matching account found for that email address and password.'
    )->throw();
}



redirect('/');
