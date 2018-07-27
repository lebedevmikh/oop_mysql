<?php
	require_once 'structure.php'; 						//подключаем структуру класса
	require_once 'config.php'; 							//подключаем константы
	$db = new db(HOST, USERNAME, PASSWORD, DATABASE);	//инициализируем класс
	#$db->documentation();								//документация(выводится в консоль)
	$arr = $db->get("SELECT * FROM `test` WHERE 1");
	echo $arr[0]["id"];
?>
