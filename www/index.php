<?php 

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



$mconn_obj = new MConnect();
$mconn = $mconn_obj->connectMQL();
$mdb = $mconn_obj->mdb;

// Получим информацию о группах, которые есть в БД
$groups_in_db = $mdb->select('groups', ['name'], [
	"ORDER" => [
		"name" => "ASC",
	]
]);

// Для отображения года внизу
$msk_date = new \DateTime('', new \DateTimeZone('Europe/Moscow'));
$msk_year = $msk_date->format('Y');

?>

<!doctype html>
<html lang="ru">
	<head>
		<meta charset="utf-8">
		<meta name="robots" content="noindex">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="Результаты соревнований">
		<meta name="author" content="Club Magnit Ltd.">
		<meta name="generator" content="Club Magnit Script">
		<title>Результаты соревнований</title>

		<!-- Bootstrap core CSS -->
		<link href="./assets/dist/css/bootstrap.css" rel="stylesheet">

		<script src='./jquery-3.5.1.min.js'></script>
		
		<style>
			.bd-placeholder-img {
				font-size: 1.125rem;
				text-anchor: middle;
				-webkit-user-select: none;
				-moz-user-select: none;
				-ms-user-select: none;
				user-select: none;
			}

			@media (min-width: 768px) {
				.bd-placeholder-img-lg {
					font-size: 3.5rem;
				}
			}
		</style>
	</head>

	<body style="padding-top: 5rem;">
		<nav class="navbar navbar-expand-md navbar-light bg-light fixed-top">

			<a class="navbar-brand" href="/">ClubMagnit</a>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarsExampleDefault">
				<ul class="navbar-nav mr-auto">

					<li class="nav-item">
						&nbsp;
					</li>

					<?php
						if ($_SERVER['REQUEST_URI'] != '/') {
					?>
					<li class="nav-item">
						<a class="btn btn-success" href="/">Назад на главную</a>
					</li>

					<?php
						} 
					?>

				</ul>
			</div>
		</nav>

<?php 

// Когда запрос идет на главную страницу, без группы
if ( !isset($_GET['group']) ){

?>
		<main role="main" class="container">
			<div class="table-responsive">
				<h1>Результаты</h1>
				<table class="table table-borderless table-hover table-sm">
					<tbody>
						<?php 

							$st = 0;
							foreach ($groups_in_db as $key => $value) {
								$st = $st + 1;
								if ($st == 1) {
									echo('<tr>');
								}

								echo('<td>');
								echo('<a href="./?group='.$value['name'].'&type=0">');
								echo($value['name']);
								echo('</a>');
								echo('</td>');

								if ($st == 2) {
									echo('</tr>');
									$st = 0;
								}
							}

						 ?>
					</tbody>
				</table>
			</div>

			<div class="table-responsive">
				<h1>Стартовые протоколы</h1>
				<table class="table table-borderless table-hover table-sm">
					<tbody>
						<?php 

							$st = 0;
							foreach ($groups_in_db as $key => $value) {
								$st = $st + 1;
								if ($st == 1) {
									echo('<tr>');
								}

								echo('<td>');
								echo('<a href="./?group='.$value['name'].'&type=2">');
								echo($value['name']);
								echo('</a>');
								echo('</td>');

								if ($st == 2) {
									echo('</tr>');
									$st = 0;
								}
							}

						 ?>
					</tbody>
				</table>
			</div>
		</main>
<?php
} else {
	// Когда запрос идет на группу определенную
	// Проверим, что такая группа существует
	$group = strtoupper( htmlspecialchars( substr($_GET['group'], 0, 25) ) );
	$where = [ "name" => $group ];
	if (!$mdb->has('groups', $where)) {
?>

		<main role="main" class="container">
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
				Такой группы нету
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
		</main>

<?php
	} else {

		$view_type = 0;
		if ( isset($_GET['type']) ){
			$view_type = intval(substr($_GET['type'], 0, 5));
		}

		// Получим результаты по группе
		$results = $mdb->select("results", ['name', 'organization', 'result_ms', 'result_status', 'card_number',  'start', 'splits'], [
			"group_name" => $group,
			"out_of_competition" => 0,
			"result_status" => "OK",
			"ORDER" => [
				"result_ms" => "ASC",
				]
		]);

		$results_disc = $mdb->select("results", ['name', 'organization', 'result_ms', 'card_number',  'start', 'result_status'], [
			"group_name" => $group,
			"result_status[!]" => "OK",
			"ORDER" => [
				"result_ms" => "ASC",
				]
		]);

		// Посчитаем максимальное кол-во КП на дистанции
		$max_kp = 0;
		foreach ($results as $num => $result_cnt) {
			if ( isset($result_cnt['splits']) ) {
				$splits_arr = json_decode($result_cnt['splits'], true);
				if (!empty($splits_arr)) {
					$curr_cnt = count($splits_arr);
					if ($max_kp < $curr_cnt) {
						$max_kp = $curr_cnt;
					}
				}
			}
		}
		$max_kp = $max_kp + 4;

		// Результаты
		if ($view_type == 0) {
?>
		<main role="main" class="container">
			<div><h1>Результаты <?php echo($group); ?></h1></div>
			<div class="table-responsive">
				<table class="table table-striped table-borderless">
					<tbody>
						<?php 
							echo('<tr>');
							echo('<td><strong>№</strong></td>');
							echo('<td><strong>Фамилия, имя</strong></td><td><strong>Результат</strong></td><td><strong>Проверка КП</strong></td>');

							$tr = 0;
							for ($i=0; $i < $max_kp; $i++) { 
								if ($i > 3) {
									$tr = $tr + 1;
									echo('<td><strong>КП#'.$tr.'</strong></td>');
								}
							}

							echo('</tr>');

							$st = 0;
							foreach ($results as $num => $result) {
								$st++;
								echo('<tr>');
								echo('<td>' . $st . '.</td>');
								echo('<td>' . $result['name'] ?? 'empty' . '</td>');
								$seconds = $result['result_ms'] / 100;
								$hours = intdiv(($seconds % 86400), 3600);
								$minutes = intdiv(($seconds % 3600), 60);
								$seconds = $seconds % 60;
								if (strlen(strval($hours)) == 1) {
									$hours = '0' . strval($hours);
								}
								if (strlen(strval($minutes)) == 1) {
									$minutes = '0' . strval($minutes);
								}
								if (strlen(strval($seconds)) == 1) {
									$seconds = '00';
								}
								echo('<td>');
								echo($hours.':'.$minutes.':'.$seconds);
								echo('</td>');
								echo('<td>' . $result['result_status'] ?? 'unknown' . '</td>');
								

								if ( isset($result['splits']) ) {
									$split_arr = json_decode($result['splits'], true);
									if (is_array($split_arr)) {
										// var_dump($split_arr);die();
										foreach ($split_arr as $num => $split) {
											echo('<td>');
											$split_seconds = round($split['time']);
											$hours = gmdate("H", $split_seconds);
											$minutes = gmdate("i", $split_seconds);
											$seconds = gmdate("s", $split_seconds);

											if (strlen(strval($hours)) == 1) {
												$hours = '0' . strval($hours);
											}
											if (strlen(strval($minutes)) == 1) {
												$minutes = '0' . strval($minutes);
											}
											if (strlen(strval($seconds)) == 1) {
												$seconds = '00';
											}
											if ($hours != 0) {
												echo($hours.':'.$minutes.':'.$seconds);
											} else {
												echo($minutes.':'.$seconds);
											}
												
											echo('</td>');
										}
									}
								}
								echo('</tr>');
							}
						 ?>


						 <?php
						 	$results_didnt_start = array();
							foreach ($results_disc as $num => $result_d) {
								if ( $result_d['result_status'] != 'DID_NOT_START' ) {
									$st++;
									echo('<tr>');
									echo('<td>' . $st . '.</td>');
									echo('<td>' . $result_d['name'] ?? 'empty' . '</td>');
									$seconds = $result_d['result_ms'] / 100;
									$hours = intdiv(($seconds % 86400), 3600);
									$minutes = intdiv(($seconds % 3600), 60);
									$seconds = $seconds % 60;
									if (strlen(strval($hours)) == 1) {
										$hours = '0' . strval($hours);
									}
									if (strlen(strval($minutes)) == 1) {
										$minutes = '0' . strval($minutes);
									}
									if (strlen(strval($seconds)) == 1) {
										$seconds = '00';
									}
									echo('<td>');
									echo($hours . ':' . $minutes . ':' . $seconds);
									echo('</td>');
									echo('<td>' . $result_d['result_status'] ?? 'unknown' . '</td>');

									for ($i=0; $i < $max_kp-4; $i++) { 
										echo('<td></td>');
									}

									echo('</tr>');
								} else {
									$res_tmp = array();
									$res_tmp['name'] = $result_d['name'];
									$res_tmp['result_status'] = $result_d['result_status'];
									$results_didnt_start[] = $res_tmp;
								}
							}

							foreach ($results_didnt_start as $num => $result) {
								$st++;
								echo('<tr>');
								echo('<td>' . $st . '</td>');
								echo('<td>' . $result['name'] ?? 'empty' . '</td>');
								echo('<td>');
								echo('</td>');
								echo('<td>' . $result['result_status'] ?? 'unknown' . '</td>');
								for ($i=0; $i < $max_kp-4; $i++) { 
									echo('<td></td>');
								}
								echo('</tr>');
							}
						 
						 ?>
					</tbody>
				</table>

			</div>
		</main>
<?php
		}


		// Стартовые протоколы
		if ($view_type == 2) {


?>

		<main role="main" class="container">
			<div><h1>Стартовые протоколы <?php echo($group); ?></h1></div>
			<div class="table-responsive">
				<table class="table table-striped table-borderless">
					<tbody>
						<?php 
							echo('<tr>');
							echo('<td><strong>№</strong></td>');
							echo('<td><strong>Фамилия, имя</strong></td><td><strong>Время старта</strong></td><td><strong>Коллектив</strong></td><td><strong>Номер чипа</strong></td>');

							$tr = 0;
							for ($i=0; $i < $max_kp; $i++) { 
								if ($i > 3) {
									$tr = $tr + 1;
									echo('<td><strong>КП#'.$tr.'</strong></td>');
								}
							}

							echo('</tr>');

							$st = 0;
							foreach ($results as $num => $result) {
								$st++;
								echo('<tr>');
								echo('<td>' . $st . '.</td>');
								echo('<td>' . $result['name'] ?? 'empty' . '</td>');

								$split_seconds = round($split['start']);
								$hours = gmdate("H", $split_seconds);
								$minutes = gmdate("i", $split_seconds);
								$seconds = gmdate("s", $split_seconds);
								
								// $seconds = $result['start'] / 100;
								// $hours = intdiv(($seconds % 86400), 3600);
								// $minutes = intdiv(($seconds % 3600), 60);
								// $seconds = $seconds % 60;
								// if (strlen(strval($hours)) == 1) {
								// 	$hours = '0' . strval($hours);
								// }
								// if (strlen(strval($minutes)) == 1) {
								// 	$minutes = '0' . strval($minutes);
								// }
								// if (strlen(strval($seconds)) == 1) {
								// 	$seconds = '00';
								// }
								echo('<td>');
								echo($hours.':'.$minutes.':'.$seconds);
								echo('</td>');
								echo('<td>' . $result['organization'] ?? 'unknown' . '</td>');
								echo('<td>' . $result['card_number'] ?? 'unknown' . '</td>');
								echo('</tr>');
							}
						 ?>


						
					</tbody>
				</table>

			</div>
		</main>
<?php
		}
	}
}
?>

		<footer class="container">
			<p class="mt-5 mb-1 text-muted text-center">&copy; ClubMagnit 2017-<?php echo($msk_year);?> 
			</p>
			
		</footer>

		<script src="./assets/dist/js/bootstrap.bundle.js"></script>
	</body>
</html>





