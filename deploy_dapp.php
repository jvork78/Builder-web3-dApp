<?php

if (empty($_POST['id'])) exit;

require_once('classes/Helper.php');
require_once('classes/SendGrid.php');
session_start();

$currentUser = Helper::getCurrentUser();

if (!$currentUser) exit;

$id = $_POST['id'];
$address = empty($_POST['address']) ? '' : $_POST['address'];
$user = $currentUser->getId();
$email = $currentUser->getEmail();

$db = db::getInstance();
