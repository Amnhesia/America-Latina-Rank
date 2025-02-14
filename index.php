<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href=favicon.ico type="image/x-icon">
</head>
<body>

<?php
define('HX_STATS', true);
include dirname(__FILE__).'/system/hx_function.php';
include dirname(__FILE__).'/system/hx_config.php';

$sql = new Class_mysqli($aDB['server'], $aDB['username'], $aDB['passwd'], $aDB['dbname']);
$sContent='';

$sGet = hx_get_string('f');
if ($sGet) {
	$aBuf = $sql->query_array("SELECT * FROM `".$aDB['table']."` WHERE `Steamid` LIKE '".$sGet."'");
	if ($aBuf) {
		foreach($aBuf as $a) {
			if (!empty($a)) {
				$aConf['title'] .= ' '.$a['Name'];
				
				if($aConf['language'] == 'en')
				{
					$sContent .='<h2>Player: '.$a['Name'].'</h2>';
					$sContent .='<a class="noob" target="_blank" href="'.hx_steam($sGet).'">Steam profile</a><br>';
					$sContent .='<p>Points: '.$a['Points'].'</p>';
					$sContent .='<p>Infected: '.$a['Infected'].'</p>';
					$sContent .='<p>Boomer: '.$a['Boomer'].'</p>';
					$sContent .='<p>Hunter: '.$a['Hunter'].'</p>';
					$sContent .='<p>Smoker: '.$a['Smoker'].'</p>';
					if ($aConf['L4D2']) {
						$sContent .='<p>Charger: '.$a['Charger'].'</p>';
						$sContent .='<p>Jockey: '.$a['Jockey'].'</p>';
						$sContent .='<p>Spitter: '.$a['Spitter'].'</p>';
					}
					$sContent .='<p>Tank: '.$a['Tank'].'</p>';
					$sContent .='<p>Tank (in solo): '.$a['TankSolo'].'</p>';
					$sContent .='<p>Witch: '.$a['Witch'].'</p>';
					$sContent .='<p>Headshots: '.$a['HeadShot'].'</p>';
					$sContent .='<p>Total time: '.(int)($a['Time1']/60).' (hours)</p>';
					$sContent .='<p>Last visit: '.date('d.m.Y', (int)$a['Time2']).'</p>';
				}
				else {
					$sContent .='<h2>Игрок: '.$a['Name'].'</h2>';
					$sContent .='<a class="noob" target="_blank" href="'.hx_steam($sGet).'">Профиль Steam</a><br>';
					$sContent .='<p>Очков: '.$a['Points'].'</p>';
					$sContent .='<p>Заражённых: '.$a['Infected'].'</p>';
					$sContent .='<p>Толстяк: '.$a['Boomer'].'</p>';
					$sContent .='<p>Охотник: '.$a['Hunter'].'</p>';
					$sContent .='<p>Курильщик: '.$a['Smoker'].'</p>';
					if ($aConf['L4D2']) {
						$sContent .='<p>Громила: '.$a['Charger'].'</p>';
						$sContent .='<p>Жокей: '.$a['Jockey'].'</p>';
						$sContent .='<p>Плевальщица: '.$a['Spitter'].'</p>';
					}
					$sContent .='<p>Танк: '.$a['Tank'].'</p>';
					$sContent .='<p>Танк (в одиночку): '.$a['TankSolo'].'</p>';
					$sContent .='<p>Ведьма: '.$a['Witch'].'</p>';
					$sContent .='<p>В голову: '.$a['HeadShot'].'</p>';
					$sContent .='<p>Времени в игре: '.(int)($a['Time1']/60).' (часов)</p>';
					$sContent .='<p>Последнее посещение: '.date('d.m.Y', (int)$a['Time2']).'</p>';
				}
			}
		}
	}
	else {
		$sContent ='<p>Error 1</p>';
	}
}
else {
	if($aConf['language'] == 'en')
	{
		$sContent ='<h2>Top players</h2>';
		$sContent .='<form action="index.php" method="get"><input type="search" size="21" name="f" placeholder="STEAM_ID" maxlength="23"><button type="submit">Search</button></form><br>';
	}
	else {
		$sContent ='<h2>Чемпионы</h2>';
		$sContent .='<form action="index.php" method="get"><input type="search" size="21" name="f" placeholder="STEAM_ID" maxlength="23"><button type="submit">Искать</button></form><br>';
	}
	
	$aBuf = $sql->query_array("SELECT `Steamid`, `Name`, `Points` FROM `".$aDB['table']."` WHERE `Hide` = 0 ORDER BY `Points` DESC LIMIT ".$aConf['limit']);
	if ($aBuf) {
		$i=0;
		foreach($aBuf as $a) {
			if (!empty($a)) {
				$i +=1;
				if($aConf['language'] == 'en')
				{
					$sContent .= '<a class="noob" target="_self" href="index.php?f='.$a['Steamid'].'">'.$i.'. '.$a['Name'].' - '.$a['Points'].' Points</a><br>';
				}
				else {
					$sContent .= '<a class="noob" target="_self" href="index.php?f='.$a['Steamid'].'">'.$i.'. '.$a['Name'].' - '.$a['Points'].' очков</a><br>';
				}
			}
		}
	}
	else {
		$sContent ='<p>Error 2</p>';
	}
}

$tpl = new Class_template();
$tpl->set_title($aConf['title']);
$tpl->set_description($aConf['description']);
$tpl->set_keywords($aConf['keywords']);
$tpl->set_content($sContent);

echo $tpl->get_main_tpl();
?>
</body>
</html>
