<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
 * Admin Routes
 */
$route[$adminPrefix . '/coinpayments'] = 'admin/Coinpayments/index';
$route[$adminPrefix . '/coinpayments/latest_withdraws'] = 'admin/Coinpayments/latestWithdraws';
$route[$adminPrefix . '/coinpayments/install'] = 'admin/Coinpayments/install';
$route[$adminPrefix . '/coinpayments/uninstall'] = 'admin/Coinpayments/uninstall';
$route[$adminPrefix.'/coinpayments/empty_logs'] = 'admin/Coinpayments/emptyLogs';

/*
 * Site Routes
 */
if (!$route['withdrawal']['post']) {
	$route['withdrawal']['post'] = 'Coinpayments/withdrawal';
}
//Ipn Route
$route['coinpayments_withdrawal_ipn']= 'Coinpayments/ipn';
