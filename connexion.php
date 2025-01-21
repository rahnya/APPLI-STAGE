<?php
require_once 'UserController.php';

$controller = new UserController();
$controller->seConnecter();

require 'index.html';
