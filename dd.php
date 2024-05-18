<?php


$dd = [
    "user" => [
        "create" => 1,
        "read" => 1,
        "update" => 1,
        "delete" => 1
    ],
    "role" => [
        "create" => 1,
        "read" => 1,
        "update" => 1,
        "delete" => 1
    ],
    "stagiaire" => [
        "create" => 1,
        "read" => 1,
        "update" => 1,
        "delete" => 1
    ],
    "categorie" => [
        "create" => 1,
        "read" => 1,
        "update" => 1,
        "delete" => 1
    ]
];

echo serialize($dd);