<?php

// $name = "Dark Matter";
// $read = false;
// if ($read) {
//     $message = "you have read $name";
// } else {
//     $message = "You have not read $name";
// }

// $books = [
//     [
//         "name" => "Do Android Dream of You",
//         "author" => "Andy Weir",
//         "releaseYear" => "1993",
//         "purchaseURL" => "www.example.com"
//     ], [
//         "name" => "Redbird",
//         "author" => "Ronald Weir",
//         "releaseYear" => "1208",
//         "purchaseURL" => "www.example.com"
//     ], [
//         "name" => "Yellow",
//         "author" => "Perl Weir",
//         "releaseYear" => "2001",
//         "purchaseURL" => "www.example.com"
//     ]
// ];

// function filter($books, $author)
// {
//     $filteredItems = [];

//     foreach ($books as $book) {
//         if ($book['author'] === $author) {
//             $filteredItems[] = $book;
//         }
//     }

//     return $filteredItems;
// }

// $filteredBooks = filter($books, "Ronald Weir");






view("index.view.php", [
    'heading' => 'Home'
]);
