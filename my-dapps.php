<?php

require_once('classes/Helper.php');
session_start();

$currentUser = Helper::getCurrentUser();

if (!$currentUser) {
	header('Location: /login.php?redirect=builder');
	exit;
