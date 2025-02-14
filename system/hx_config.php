<?php
if(!defined('HX_STATS')){exit();}

$aDB=array();
$aDB['server'] =	'127.0.0.1'; 			// usually, it's ip or web-address of your database
$aDB['username'] =	'your_user';
$aDB['passwd'] =	'your_password';
$aDB['dbname'] =	'your_database_name';
$aDB['table'] =		'l4d2_stats'; 			// change it if only you want to have separate statistics for several servers, without sharing points.
											// in such case you also need to change "l4d_hxstat_table" and "l4d_hxstat_table_backup" ConVars of plugin.

$aConf=array();
$aConf['title'] = 'Stats players:';					// title of web-site page
$aConf['description'] = '[L4D] hx_stats (Co-op)';
$aConf['keywords'] = '[L4D] hx_stats (Co-op)';
$aConf['limit'] = '50';								// maximum number of players displayed in top
$aConf['L4D2'] = '1';								// 0 - for L4D1, 1 - for L4D2
$aConf['language'] = 'en';							// valid values are: "en" or "ru"
