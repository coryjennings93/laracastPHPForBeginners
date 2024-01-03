<?php

use Core\Validator;
use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$email = $_POST['email'];
$password = $_POST['password'];

// validate form inputs
$errors = [];
if (!Validator::email($email)) {
    $errors['email'] = 'Please provide a valid email address.';
}

if (!Validator::string($password, 7, 255)) {
    $errors['password'] = 'Please provide a password of at least 7 characters.';
}

if (!empty($errors)) {
    return view('registration/create.view.php', [
        'errors' => $errors
    ]);
}



// check to see if account already exists
$user = $db->query('SELECT * FROM users WHERE email = :email', [
    'email' => $email
])->find();

if ($user) {
    // someone with this email already exists
    // if yes, let user know and redirect to login page
    header('location: /');
    exit();
} else {
    // if not, save one to the database, then log user in, then redirect
    // start working with sessions
    $db->query('INSERT INTO users(name, email, password) VALUES(:name, :email, :password)', [
        'name' => null,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT)
    ]);

    // mark that the user has logged in aka session
    login([
        'email' => $email
    ]);



    header('location: /');
    exit();
}
