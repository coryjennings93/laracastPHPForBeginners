<?php

use Core\Database;
use Core\App;

$db = App::resolve(Database::class);


$currentUserId = 1;


// find matching note to query string
$note = $db->query('SELECT * FROM notes WHERE id = :id', ['id' => $_GET['id']])->findOrFail();


// authorization; keeps user from inserting an id in the query that is from a different user
authorize($note['user_id'] == $currentUserId);

view("notes/edit.view.php", [
    'heading' => 'Edit Note',
    'errors' => [],
    'note' => $note
]);
