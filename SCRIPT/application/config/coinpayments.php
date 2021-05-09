<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Coinpayments API Private Key
| https://www.coinpayments.net/acct-api-keys
| -------------------------------------------------------------------------
*/
$config['coin_pv'] = 'PRIVATEKEYHERE';

/*
| -------------------------------------------------------------------------
| Coinpayments API Public Key
| https://www.coinpayments.net/acct-api-keys
| -------------------------------------------------------------------------
*/
$config['coin_pb'] = 'PUBLICKEYHERE';

/*
| -------------------------------------------------------------------------
| Coinpayments Merchant ID
| https://www.coinpayments.net/acct-settings
| Can be found on 'Basic Settings' tab.
| -------------------------------------------------------------------------
*/
$config['coin_mid'] = 'MERCHANTIDHERE';

/*
| -------------------------------------------------------------------------
| Coinpayments IPN Secret Key
| https://www.coinpayments.net/acct-settings
| Set this on 'Merchant Settings' tab, IPN Secret Key.
| -------------------------------------------------------------------------
*/
$config['coin_sec'] = 'SECRETKEYHERE';
