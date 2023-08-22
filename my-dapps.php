<?php

require_once('classes/Helper.php');
session_start();

$currentUser = Helper::getCurrentUser();
