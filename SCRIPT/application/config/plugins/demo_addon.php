<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Admin Routes
 */
$route[$adminPrefix.'/demo_addon'] = 'admin/DemoAddon/index';
$route[$adminPrefix.'/demo_addon/install'] = 'admin/DemoAddon/install';
$route[$adminPrefix.'/demo_addon/uninstall'] = 'admin/DemoAddon/uninstall';

/*
 * Site Routes
 */
