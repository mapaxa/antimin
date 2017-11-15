<?php /*прога тупо удаляет суффикс -min в файлах после optimizilla */ ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<?php // phpinfo();
$path = $_SERVER['DOCUMENT_ROOT'] . $_SERVER['REQUEST_URI'] . 'min';
$path_without_min = $_SERVER['DOCUMENT_ROOT'] . $_SERVER['REQUEST_URI'] . 'antimin';
$mtime = microtime();  //Считываем текущее время
$mtime = explode(" ",$mtime);    //Разделяем секунды и миллисекунды
$tstart = $mtime[1] + $mtime[0]; // и записываем стартовое время в переменную

if(file_exists($path)){
	$files_with_min = scandir($path);
	$i = 0;
	foreach ($files_with_min as $file) {
		if(stristr($file, '-xmin') == true){
			$name_without_min = str_replace('-xmin', '', $file);
			$i++;
			rename($path. '/' . $file, $path_without_min . '/' . $name_without_min) or die("Не могу переписать файлы. Скорее всего, нет доступа.");
		}
	}
	echo $i . ' файлов обработано' . '<br>';
	$mtime = microtime();
	$mtime = explode(" ",$mtime);
	$mtime = $mtime[1] + $mtime[0];
	$totaltime = ($mtime - $tstart);//Вычисляем разницу
	echo "Скрипт отработал за $totaltime секунд.";
}
else{ die('что-то с папкой '); }
?> 	
</body>
</html>