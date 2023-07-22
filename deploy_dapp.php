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
try {
	$query = $db->prepare('SELECT * FROM `dapps` WHERE `user` = :user AND `id` = :id AND `deployed`=0');
	$query->bindParam(':user', $user);
	$query->bindParam(':id', $id);
	$query->execute();
	$dapp = $query->fetchObject('Dapp');
} catch (PDOException $e) {
