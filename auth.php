<?php 

	// Подключаемся к базе
	$connection = mysqli_connect("localhost", "root", "", "Test");

	if (!$connection)
	{
	    die("Ошибка подключения: " . mysqli_connect_error());
	}

	// Экранируем
	$login = mysqli_real_escape_string($connection, $_POST["login"]);
	$pass = mysqli_real_escape_string($connection, $_POST["pass"]);

	// Хешируем пароль
	$pass = md5($pass);

	$result = $connection->query("SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$pass'");
	$user = $result->fetch_assoc();

	// Делаем проверки на существование юзера в базе
	if(count($user) == 0)
	{
		echo "Такой пользователь не найден.";
		exit();
	}
	else if(count($user) == 1)
	{
		echo "Логин или праоль введены неверно";
		exit();
	}

	// Если все норм, то заводим куки и перенаправляем на страницу профиля
	setcookie('user', $user['name'], time() + 3600, "/");

	$connection->close();

	header('Location: profile.php');
?>