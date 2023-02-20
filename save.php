<?php
	if (isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["sex"]) && isset($_POST["age"]))
	{
		if (!is_int((int)$_POST["age"]))
		{
			die("Введите корректный возраст!");
		}

		$connection = mysqli_connect("localhost", "root", "", "Test");

	    if (!$connection)
	    {
	        die("Ошибка подключения: " . mysqli_connect_error());
	    }

		// Экранирование
		$name = mysqli_real_escape_string($connection, $_POST["name"]);
		$surname = mysqli_real_escape_string($connection, $_POST["surname"]);
		$age = (int)(mysqli_real_escape_string($connection, $_POST["age"]));
		$sex = mysqli_real_escape_string($connection, $_POST["sex"]);

		$sqlQuery = "INSERT INTO Users (`name`, `surname`, `age`, `sex`)
					 VALUES ('$name', '$surname', '$age', '$sex')";

		if(mysqli_query($connection, $sqlQuery))
		{
    		header("Location: /");
		}
		else
		{
    		die($connection->error);
		}

		$connection->close();
	}
	else
	{
		die("Заполните недостающую информацию!");
	}
?>