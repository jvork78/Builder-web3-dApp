<?php

require_once('classes/Helper.php');
session_start();

$currentUser = Helper::getCurrentUser();

if (!$currentUser) {
	header('Location: /login.php?redirect=builder');
	exit;
}
require_once 'common/lang_setter.php';

//Profile data
require_once 'common/profiledata.php';

if (!empty($_GET['network']) && $_GET['network'] == 'rinkeby') {
    $network = 'rinkeby';
    $deployed_dapps = $deployed_rinkeby_dapps;
} else {
    $network = 'main';
    $deployed_dapps = $deployed_main_dapps;
}

if (!$deployed_dapps) {
	header('Location: /builder/new-dapp.php');
	exit;
}

require_once('common/header.php');
?>
<div id="page-wrapper">

	<div id="hackathon-container" class="container-fluid page-content">

		<section class="cont-page"> 
            <div class="container-fluid">
                <div class="row">
