<?php

use Core\App;
use Core\Database;


$db = App::resolve(Database::class);


$notes = $db->query('SELECT * FROM notes WHERE user_id = 1')->getQueryResults();




view("notes/index.view.php", [
    'heading' => "Notes",
    'notes' => $notes
]);
