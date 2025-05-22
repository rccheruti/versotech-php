<?php
require_once __DIR__ . '/vendor/autoload.php';

use controller\UserController;
use controller\ColorController;

$userController = new UserController();
$users = $userController->getUsers();

$colorController = new ColorController();
$colors = $colorController->getAllColors();

@include __DIR__ . '/views/index.php';
