<?php

use Core\{App, Validator, Database};



$db = App::resolve(Database::class);


$errors = [];

// $_POST is a superglobal that contains attributes of submitted form
// returns an array of all of the attributes from the submitted form

if (!Validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = 'A body of no more than 1,000 characters is required';
}

if (!empty($errors)) {
    // validation issue
    return view("notes/create.view.php", [
        'heading' => 'Create Note',
        'errors' => $errors
    ]);
}


$db->query('INSERT INTO notes(body, user_id) VALUES(:body, :user_id)', [
    'body' => $_POST['body'],
    'user_id' => 1 // hard coded
]);


header('location: /notes');
die();
