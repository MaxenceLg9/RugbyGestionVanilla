<?php
session_start();
if(empty($_SESSION['email'])){
    header('Location: login');
    die();
}

$matchs = [
    [
        'idMatchDeRugby' => -1,
        'dateHeure' => "2021-01-01 14:30:00",
        'adversaire' => "RC Valence",
        'lieu' => "Stade de Mondimrade",
        'resultat' => "futur",
    ],
    [
        'idMatchDeRugby' => -1,
        'dateHeure' => "2021-01-01 14:30:00",
        'adversaire' => "RC Valence",
        'lieu' => "Stade de Mondimrade",
        'resultat' => "futur",
    ],
    [
        'idMatchDeRugby' => -1,
        'dateHeure' => "2021-01-01 14:30:00",
        'adversaire' => "RC Valence",
        'lieu' => "Stade de Mondimrade",
        'resultat' => "futur",
    ],
    [
        'idMatchDeRugby' => -1,
        'dateHeure' => "2021-01-01 14:30:00",
        'adversaire' => "RC Valence",
        'lieu' => "Stade de Mondimrade",
        'resultat' => "futur",
    ],
    [
        'idMatchDeRugby' => -1,
        'dateHeure' => "2021-01-01 14:30:00",
        'adversaire' => "RC Valence",
        'lieu' => "Stade de Mondimrade",
        'resultat' => "futur",
    ]
];
$css = ["style.css"];
$page = "../vue/matchs.php";
include_once "../components/page.php";
