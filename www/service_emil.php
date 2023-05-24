<?php namespace MagnitCLUB;

require __DIR__ . '/vendor/autoload.php';

use MagnitCLUB\MConnect;


// 
//  ███▄ ▄███▓ ▄▄▄        ▄████  ███▄    █  ██▓▄▄▄█████▓    ▄████▄   ██▓     █    ██  ▄▄▄▄   
// ▓██▒▀█▀ ██▒▒████▄     ██▒ ▀█▒ ██ ▀█   █ ▓██▒▓  ██▒ ▓▒   ▒██▀ ▀█  ▓██▒     ██  ▓██▒▓█████▄ 
// ▓██    ▓██░▒██  ▀█▄  ▒██░▄▄▄░▓██  ▀█ ██▒▒██▒▒ ▓██░ ▒░   ▒▓█    ▄ ▒██░    ▓██  ▒██░▒██▒ ▄██
// ▒██    ▒██ ░██▄▄▄▄██ ░▓█  ██▓▓██▒  ▐▌██▒░██░░ ▓██▓ ░    ▒▓▓▄ ▄██▒▒██░    ▓▓█  ░██░▒██░█▀  
// ▒██▒   ░██▒ ▓█   ▓██▒░▒▓███▀▒▒██░   ▓██░░██░  ▒██▒ ░    ▒ ▓███▀ ░░██████▒▒▒█████▓ ░▓█  ▀█▓
// ░ ▒░   ░  ░ ▒▒   ▓▒█░ ░▒   ▒ ░ ▒░   ▒ ▒ ░▓    ▒ ░░      ░ ░▒ ▒  ░░ ▒░▓  ░░▒▓▒ ▒ ▒ ░▒▓███▀▒
// ░  ░      ░  ▒   ▒▒ ░  ░   ░ ░ ░░   ░ ▒░ ▒ ░    ░         ░  ▒   ░ ░ ▒  ░░░▒░ ░ ░ ▒░▒   ░ 
// ░      ░     ░   ▒   ░ ░   ░    ░   ░ ░  ▒ ░  ░         ░          ░ ░    ░░░ ░ ░  ░    ░ 
//        ░         ░  ░      ░          ░  ░              ░ ░          ░  ░   ░      ░      
//                                                         ░                               ░ 

// Получим данные которые нам посылает программа

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	$answ_arr = array(
		'status' => 'error',
		'msg' 	=> 'invalid method type',
		'code' => 101
	);
	$answ_json = json_encode($answ_arr);
	echo($answ_json);
	exit(500);
}

$ddata = file_get_contents(htmlspecialchars("php://input"));
$decoded_data = json_decode($ddata, true);
$persons_arr = $decoded_data['persons'] ?? "";

if (empty($persons_arr)) {
	$answ_arr = array(
		'status' => 'error',
		'msg' 	=> 'persons_arr is empty',
		'code' => 102
	);
	$answ_json = json_encode($answ_arr);
	echo($answ_json);
	exit(500);
}

// init db conn
$mconn_obj = new MConnect();
$mconn = $mconn_obj->connectMQL();
$mdb = $mconn_obj->mdb;

foreach ($persons_arr as $num => $person) {
	$split_arr  = $person['splits'] ?? null;
	$split_json = json_encode($split_arr);

	$write_arr = [
		"id" 			=> $person['id'],
		"ref_id" 		=> $person['ref_id'] ?? "",
		"bib" 			=> $person['bib'] ?? 0,
		"group_name" 	=> strtoupper($person['group_name']) ?? "",
		"name" 			=> $person['name'] ?? "",
		"organization" 	=> $person['organization'] ?? 0,
		"card_number" 	=> $person['card_number'] ?? null,
		"national_code" => $person['national_code'] ?? null,
		"world_code" 	=> $person['world_code'] ?? null,
		"out_of_competition" => $person['out_of_competition'] ?? false,
		"start" 		=> $person['start'] ?? null,
		"result_ms" 	=> $person['result_ms'] ?? null,
		"result_status" => $person['result_status'] ?? "empty",
		"splits" 		=> $split_json ?? null
	];

	// var_dump($write_arr);die();

	$where = [ "id" => $person['id'] ];
	if ($mdb->has('results', $where)) {
		$st_swr1 = $mdb->update('results', $write_arr, $where);
	} else {
		$st_swr2 = $mdb->insert('results', $write_arr);
	}

	// Добавим группу если нету
	if ($person['group_name']) {
		$where2 = [ 'name' => strtoupper($person['group_name'])];
		if (!$mdb->has('groups', $where2)) {
			$write_arr2 = [
				'name' => strtoupper($person['group_name'])
			];
			$st_swr2 = $mdb->insert('groups', $write_arr2);
		}
	}
}

$msk_date = new \DateTime('', new \DateTimeZone('Europe/Moscow'));
$msk_year = $msk_date->format('Y');


?>

