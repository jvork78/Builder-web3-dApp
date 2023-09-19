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
                    <div class="col-md-12">
                    	<div class="title">
                        	<h1>dApp Builder <i class="fa fa-chevron-right" aria-hidden="true" style="font-size: 15px;"></i> <?php echo $_mydapps['my_dapps']; ?></h1>
                    	</div>
                    </div>
                </div>	
            </div>
		</section>
		<!--________________________________________________-->

		<div class="conteiner">
			<div class="row">
				<!--_______________________________________________________-->
				<div class="col-md-5 col-md-offset-1">
					<div class="dapp-descr"> 
						<div class="list-dapp-my list-group text-center" id="dapps-list">
