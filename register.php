<?php 

	// Подключаемся к базе
	$connection = mysqli_connect("localhost", "root", "", "Test");

	if (!$connection)
	{
	    die("Ошибка подключения: " . mysqli_connect_error());
	}

	// Экранируем
	$login = mysqli_real_escape_string($connection, $_POST["login"]);
	$name = mysqli_real_escape_string($connection, $_POST["name"]);
	$pass = mysqli_real_escape_string($connection, $_POST["pass"]);

	// Проверяем корректность логина и имени
	if(mb_strlen($login) < 5 || mb_strlen($login) > 90)
	{
		echo "Недопустимая длина логина";
		exit();
	}
	else if(mb_strlen($name) < 5)
	{
		echo "Недопустимая длина имени.";
		exit();
	}

	// Хешируем пароль
	$pass = md5($pass);

	$result1 = $connection->query("SELECT * FROM `users` WHERE `login` = '$login'");
	$user1 = $result1->fetch_assoc();

	// Если в базе есть юзер с таким логином, то ошибка
	if(!empty($user1))
	{
		echo "Данный логин уже используется!";
		exit();
	}

	// Иначе - добавляем юзера в базу и перенаправляем на /
	$connection->query("INSERT INTO `users` (`login`, `password`, `name`) VALUES('$login', '$pass', '$name')");
	$connection->close();

	header('Location: /');
	exit();
 ?>