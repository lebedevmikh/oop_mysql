<?php
	/**
	 * MySQL-интерфейс
	 */
	class db
	{
		private $host;
		private $user;
		private $password;
		private $database;
		private $link;
		private $result = [];
		function __construct($path, $username, $passwd, $data)
		{
			$this->setHost($path);
			$this->setUsername($username);
			$this->setPassword($passwd);
			$this->setDataBase($data);
			$this->logIn();
		}
		private function setHost($value='localhost')
		{
			$this->host = $value;
		}
		private function setUsername($value='root')
		{
			$this->user = $value;
		}
		private function setPassword($value='')
		{
			$this->password = $value;
		}
		private function setDataBase($value='')
		{
			$this->database = $value;
		}
		private function logIn()
		{
			$this->link = mysqli_connect($this->host, $this->user, $this->password, $this->database) or $this->error();
			mysqli_select_db($this->link,$this->database);
		}
		private function error()
		{	
			mysqli_error($this->link);
			die("Возникла критическая ошибка <br>
				Возможные варианты ошибки:<br>
				1. MySQL-сервер не отвечает<br>
				2. Ошибки в константах, которые вы ввели<br>
				3. Ошибка в функции get(), Вы ввели неправильные аргументы<br>
				4. Неправильный SQL-синтаксис");
		}
		private function close()
		{
			mysqli_close($this->link);
		}
		private function query($query)
		{
			$result = mysqli_query($this->link, $query) or $this->error();
			if($result)
			{
				while ($row = mysqli_fetch_array($result))
				{
				 	array_push($this->result, $row);
   				}
			}else{
				$this->error();
				$this->close();
			} 
		}
		public function get($query)
		{
			if($query)
			{	
				$this->result = [];
				$this->query($query);
				return $this->result;
			}else
			{
				$this->error();
			}
			
		}
		public function documentation()
		{	
			echo '<script type="text/javascript">';
			echo 'console.log("Этот код написан на объектно-ориентированном PHP
				Этот класс позволяет установить связь с вашей БД
				и отправялть к ней запросы
				
				Измените константы для подключения к своей базе данных
				Константы находятся в файле config.php
				
				Для подключения создайте экземпляр этого класса(скорее всего, вы уже это сделали, раз читаете это)
				Как это сделать показано в файле index.php
				
				1. Подключите класс 		require_once structure.php;
				2. Подключите Константы 	require_once config.php;
				3. Инициализируйте объект 	$db = new db(HOST, USERNAME, PASSWORD, DATABASE);

				Все методы этого класса являются приватными, т.е их нельзя использовать за пределами этого класса
				Публичным является только метод get()
				Чтобы его вызвать используйте $db->get($query);
				Где $query - строка, состоящая из SQL-запроса
				Для примера: SELECT * FROM название таблицы WHERE 1
				выведет все строки таблицы

				Метод get() возращает массив с данными, которые возрастил MySQL-сервер
				Чтобы использовать метод get(), приравняйте его к вашему массиву
				Для обращения к конкретным эелементам используйте массив[0][ключ]
				Для примера:
				
				$arr = $db->get("SELECT * FROM `test` WHERE 1");
				echo $arr[0]["id"];
				
				Еще вы можете использовать метод documentation(), чтобы прочитать этот текст в консоли разработчика (консоль отладки кода JS)
				Используйте его только для рабочих целей, для ознакомления с моим классом

				
				Пользуйтесь на здоровье, находите баги и ошибки(буду исправлять)

				Автор: Михаил Лебедев
				https://github.com/lebedevmikh");';
			echo '</script>';

			/*
				Этот код написан на объектно-ориентированном PHP
				Этот класс позволяет установить связь с вашей БД
				и отправялть к ней запросы
				
				Измените константы для подключения к своей базе данных
				Константы находятся в файле config.php
				
				Для подключения создайте экземпляр этого класса(скорее всего, вы уже это сделали, раз читаете это)
				Как это сделать показано в файле index.php
				
				1. Подключите класс 		require_once structure.php;
				2. Подключите Константы 	require_once config.php;
				3. Инициализируйте объект 	$db = new db(HOST, USERNAME, PASSWORD, DATABASE);

				Все методы этого класса являются приватными, т.е их нельзя использовать за пределами этого класса
				Публичным является только метод get()
				Чтобы его вызвать используйте $db->get($query);
				Где $query - строка, состоящая из SQL-запроса
				Для примера: SELECT * FROM `название таблицы` WHERE 1
				выведет все строки таблицы

				Метод get() возращает массив с данными, которые возрастил MySQL-сервер
				Чтобы использовать метод get(), приравняйте его к вашему массиву
				Для обращения к конкретным эелементам используйте массив[0][ключ]
				Для примера:
				
				$arr = $db->get("SELECT * FROM `test` WHERE 1");
				echo $arr[0]["id"];

				Еще вы можете использовать метод documentation(), чтобы прочитать этот текст в консоли разработчика (консоль отладки кода JS)
				Используйте его только для рабочих целей, для ознакомления с моим классом

				
				Пользуйтесь на здоровье, находите баги и ошибки(буду исправлять)

				Автор: Михаил Лебедев
				https://github.com/lebedevmikh
			*/
		}
	}
?>