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
							<div class="my-title">
								<h4><?php echo $_mydapps['my_dapps']; ?>:</h4>
							</div>
							</div>

                            <?php $first = true; foreach ($deployed_dapps as $dapp) { ?>
                                <a data-id="<?php echo $dapp->getId(); ?>" class="list-group-item <?php echo ($first) ? 'active' : 'inactive'; ?>"> <i class="fa fa-check-square hidden-xs" aria-hidden="true"></i> 
                                   <?php echo $dapp->getName(); ?>
                                </a>
                            <?php $first = false; } ?>
						</div>
                        <div class="text-center"><button id="add-widget" type="button" class="btn btn-add"><?php echo $_mydapps['add_selected_dApp']; ?></button>
                        </div>
						<div class="text-center"><a class="btn btn-customize" id="customize-template" style="cursor:pointer;"><i class="fa fa-pencil-square-o hidden-xs" aria-hidden="true"></i> <?php echo $_mydapps['customize_dApps']; ?></a>
						</div>	
					<div class="desktoplink text-center">
                            <h4><?php echo $_mydapps['desktop_link']; ?></h4>
							<div class="input-group">
                                <input id="dapp-link" readonly type="text" class="form-control" aria-describedby="dapp-link-label" >
                                <span class="input-group-btn">
									<button id="dapp-link-copy" class="btn btn-primary" type="button"><?php echo $_mydapps['copy']; ?></button>
                                </span>
							</div>
							<h4 style="margin-top: 15px;"><?php echo $_mydapps['share_soc']; ?></h4>
							<div class="share42init" data-url="" data-icons-file="icons.png" data-path="/builder/assets/share42/" data-image="https://dappbuilder.io/builder/assets/images/dappimg.png"
							> 
							</div>
							<script type="text/javascript" src="assets/share42/share42-new.js"></script>
						</div>
					</div>
				</div>
				<!--_______________________________________________________-->
				<div class="col-md-4 col-md-offset-1">
                    <div class="block-iframe">
						<iframe id="dapp-iframe" style="width:100%;height:500px;"></iframe>
                    </div>	
				</div>
				<!--_______________________________________________________-->
			</div>
		</div>	
	</div>
</div>

<?php foreach ($deployed_dapps as $dapp) { $interface = $dapp->getInterface(); ?>
<?php if ($dapp->getDappType() == 'voting') { ?>
	<div id="templateModal<?php echo $dapp->getId(); ?>" class="modal fade" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header text-center">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h2><?php echo $_mydapps['template_settings']; ?></h2>
				</div>
				<div class="modal-body">
					<form method="post" class="template-form">
						<div class="one-settings">
                            <p class="text-center"><?php echo $_mydapps['background_color']; ?></p>
                            <div class="input-group colorpicker-component colorpicker-input">
                            	<input name="background_color" type="text" class="form-control input-lg" value="<?php echo $interface['background_color']; ?>" required>
                            	<span class="input-group-addon"><i></i></span>
                            </div>
						</div>
						<div class="one-settings">
                            <p class="text-center"><?php echo $_mydapps['text_color']; ?></p>
                            <div class="input-group colorpicker-component colorpicker-input">
                            	<input name="text_color" type="text" class="form-control input-lg" value="<?php echo $interface['text_color']; ?>" required>
                            	<span class="input-group-addon"><i></i></span>
                            </div>
						</div>						
						<div class="one-settings">
                            <p class="text-center"><?php echo $_mydapps['headers_color']; ?></p>
                            <div class="input-group colorpicker-component colorpicker-input">
                                <input name="headers_color" type="text" class="form-control input-lg" value="<?php echo $interface['headers_color']; ?>" required>
                                <span class="input-group-addon"><i></i></span>
                            </div>
						</div>
						<div class="one-settings">
                            <p class="text-center"><?php echo $_mydapps['links_color']; ?></p>
                            <div class="input-group colorpicker-component colorpicker-input">
                                <input name="links_color" type="text" class="form-control input-lg" value="<?php echo $interface['links_color']; ?>" required>
                                <span class="input-group-addon"><i></i></span>
                            </div>
						</div>
						<div class="one-settings">
							<p class="text-center"><?php echo $_mydapps['ethereum_add_color']; ?></p>
							<div class="input-group colorpicker-component colorpicker-input">
								<input name="eth_addresses_color" type="text" class="form-control input-lg" value="<?php echo $interface['eth_addresses_color']; ?>" required>
								<span class="input-group-addon"><i></i></span>
							</div>
						</div>
						<div class="one-settings">
                            <p class="text-center"><?php echo $_mydapps['pay_btn_color']; ?></p>
                            <div class="input-group colorpicker-component colorpicker-input">
                                <input name="ok_buttons_color" type="text" class="form-control input-lg" value="<?php echo $interface['ok_buttons_color']; ?>" required>
                                <span class="input-group-addon"><i></i></span>
                            </div>
						</div>
						<div class="one-settings">
                            <p class="text-center"><?php echo $_mydapps['cancel_btn_color']; ?></p>
                            <div class="input-group colorpicker-component colorpicker-input">
                                <input name="cancel_buttons_color" type="text" class="form-control input-lg" value="<?php echo $interface['cancel_buttons_color']; ?>" required>
                                <span class="input-group-addon"><i></i></span>
							</div>
						</div>
						<div class="text-center" style="padding-top:15px;">
							<button type="submit" class="btn btn-primary" style="text-transform: uppercase;"><?php echo $_mydapps['save']; ?></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php } elseif ($dapp->getDappType() == 'escrow') { ?>
	<div id="templateModal<?php echo $dapp->getId(); ?>" class="modal fade" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header text-center">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h2><?php echo $_mydapps['template_settings']; ?></h2>
				</div>
				<div class="modal-body">
					<form method="post" class="template-form">
						<div class="one-settings">
                            <p class="text-center"><?php echo $_mydapps['background_color']; ?></p>
                            <div class="input-group colorpicker-component colorpicker-input">
                            	<input name="background_color" type="text" class="form-control input-lg" value="<?php echo $interface['background_color']; ?>" required>
                            	<span class="input-group-addon"><i></i></span>
                            </div>
						</div>
						<div class="one-settings">
                            <p class="text-center"><?php echo $_mydapps['text_color']; ?></p>
                            <div class="input-group colorpicker-component colorpicker-input">
                            	<input name="text_color" type="text" class="form-control input-lg" value="<?php echo $interface['text_color']; ?>" required>
                            	<span class="input-group-addon"><i></i></span>
                            </div>
						</div>						
						<div class="one-settings">
                            <p class="text-center"><?php echo $_mydapps['headers_color']; ?></p>
                            <div class="input-group colorpicker-component colorpicker-input">
                                <input name="headers_color" type="text" class="form-control input-lg" value="<?php echo $interface['headers_color']; ?>" required>
                                <span class="input-group-addon"><i></i></span>
                            </div>
						</div>
						<div class="one-settings">
                            <p class="text-center"><?php echo $_mydapps['links_color']; ?></p>
                            <div class="input-group colorpicker-component colorpicker-input">
                                <input name="links_color" type="text" class="form-control input-lg" value="<?php echo $interface['links_color']; ?>" required>
                                <span class="input-group-addon"><i></i></span>
                            </div>
						</div>
						<div class="one-settings">
							<p class="text-center"><?php echo $_mydapps['ethereum_add_color']; ?></p>
							<div class="input-group colorpicker-component colorpicker-input">
								<input name="eth_addresses_color" type="text" class="form-control input-lg" value="<?php echo $interface['eth_addresses_color']; ?>" required>
								<span class="input-group-addon"><i></i></span>
								<span class="input-group-addon"><i></i></span>
							</div>
						</div>
						<div class="text-center" style="padding-top:15px;">
                            <button type="submit" class="btn btn-primary"><?php echo $_mydapps['save']; ?></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php } elseif ($dapp->getDappType() == 'multisig') { ?>
	<div id="templateModal<?php echo $dapp->getId(); ?>" class="modal fade" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header text-center">
