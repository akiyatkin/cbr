<?php
use infrajs\ans\Ans;
use infrajs\router\Router;
use infrajs\cache\Cache;

if (!is_file('vendor/autoload.php')) {
	chdir('../');
	require_once('vendor/autoload.php');
	Router::init();
}


$ans = array();
$day = date('j m Y'); //Кэш на один день
$data = Cache::exec(array(), __FILE__, function () {
	$src = "http://www.cbr.ru/scripts/XML_daily.asp";
	$cbr = simplexml_load_file($src);
	$attr = $cbr->attributes();
	$t = strtotime($attr['Date'][0]);
	$data = array();
	$data['date'] = $t;
	$data['list'] = array();
	for ($i = 0, $l = sizeof($cbr->Valute); $i < $l; $i++) {
		$v = $cbr->Valute[$i][0];
		$data["list"][(string)$v->CharCode] = array(
			"char" => (string)$v->CharCode,
			"title" => (string)$v->Name,
			"value" => (string)$v->Value
		);
	}
	return $data;
}, array($day), isset($_GET['re']));

$ans['data'] = $data;

return Ans::ret($ans);