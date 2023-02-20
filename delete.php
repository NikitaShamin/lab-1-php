<?php
	if (isset($_POST["id"]))
	{
		if (!is_int((int)$_POST["id"]))
		{
			die("Введите корректный ID!");
		}

		$connection = mysqli_connect("localhost", "root", "", "Test");

	    if (!$connection)
	    {
	        die("Ошибка подключения: " . mysqli_connect_error());
	    }

		// Экранирование
		$id = (int)(mysqli_real_escape_string($connection, $_POST["id"]));

		$sqlQuery = "DELETE FROM Users WHERE `id` = '$id'";

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
		die("Введите ID пользователя для удаления!");
	}
?>