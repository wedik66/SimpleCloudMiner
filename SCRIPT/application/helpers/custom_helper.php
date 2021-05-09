<?php
defined('BASEPATH') or exit('No direct script access allowed');

$composer = file_get_contents(dirname(BASEPATH) . '/composer.json');
define('SC_VERSION', json_decode($composer, 1)['version']);
define('SC_NAME', 'SCM - Simple Cloud Mining Script');

//Generate admin assets routes
if (!function_exists('adminAssets')) {
	function adminAssets($file = null)
	{
		return base_url() . 'assets/admin/' . $file;
	}
}

//Generate admin assets routes
if (!function_exists('plansAssets')) {
	function plansAssets($file = null)
	{
		return base_url() . 'assets/plans/' . $file;
	}
}

//Generate theme assets routes
if (!function_exists('themeAssets')) {
	function themeAssets($file = null)
	{
		return base_url() . 'assets/themes/' . settings('theme') . '/' . $file;
	}
}

//Generate admin routes
if (!function_exists('adminRoute')) {
	function adminRoute($route = null)
	{
		$adminPrefix = config_item('admin_route_prefix');
		return base_url($adminPrefix . '/' . $route);
	}
}

//Generate install routes
if (!function_exists('installRoute')) {
	function installRoute($route = null)
	{
		$secureUrl = ($_SERVER['HTTPS'] === "on" ? 'https://' : 'http://');
		return $secureUrl . $_SERVER['SERVER_NAME'] . '/' . $route;
	}
}

//Generate admin routes
if (!function_exists('currencyFormat')) {
	function currencyFormat($amount, $decimals = null)
	{
		$set_decimals = $decimals ?? settings('currency_decimals');
		return number_format($amount, $set_decimals, '.', '');
	}
}

//Get plans images
if (!function_exists('getPlansImages')) {
	//Plans images
	function getPlansImages()
	{
		$directory = scandir(dirname(BASEPATH) . '/assets/plans');
		$t = array();
		foreach ($directory as $value) {
			if ($value === '.' || $value === '..') {
				continue;
			}
			$t[] = $value;
		}
		return $t;
	}
}

//Get themes
if (!function_exists('getThemes')) {
	function getThemes()
	{
		$directory = scandir(dirname(BASEPATH) . '/assets/themes/');
		$t = array();
		foreach ($directory as $value) {
			if ($value === '.' || $value === '..') {
				continue;
			}
			$t[] = $value;
		}
		return $t;
	}
}

if (!function_exists('settings')) {
	function settings($param)
	{
		$CI =& get_instance();
		$CI->load->driver('cache', ['adapter' => 'file']);
		if (!$settings = $CI->cache->get('settings')) {
			$CI->cache->save('settings', $CI->settings_model->getById('settings', 1), 1800); // 30min
		}
		return $settings[$param];
	}
}

if (!function_exists('plugins_menu')) {
	function plugins_menu()
	{
		$CI =& get_instance();
		$CI->load->model('addons_model');
		$items = $CI->addons_model->getAddonsMenu();
		foreach ($items as $item) {
			$active = $CI->uri->segment(2) === $item['route'] ? "active" : "";
			echo '<li class="' . $active . '"><a href="' . adminRoute($item['route']) . '"><i class="fa ' . $item['icon'] . '"></i> ' . $item['name'] . '</a></li>';
		}
	}
}

if (!function_exists('blockchainUrl')) {
	function blockchainUrl($tx = null)
	{
		$CI =& get_instance();
		$CI->load->model('blockchains_model');
		$default = $CI->blockchains_model->getDefault();
		return $default['url'] . $tx;
	}
}

if (!function_exists('project_start_date')) {
	function project_start_date()
	{
		$start_date = date_create(settings('start_date'));
		$add_days = settings('start_date_increment');
		return date_create()->diff($start_date)->days + $add_days;
	}
}
