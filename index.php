<?php
// Section par Jul.
session_start();
$file = file("mots.txt");
$alphabet = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
require('pendu.php');
$game = new Pendu;
$game->generateWord($file);
$screenWord = strtoupper($_SESSION['word']);