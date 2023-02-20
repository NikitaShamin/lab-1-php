<!DOCTYPE html>
<html>
    <head>
        <title>LAB_2</title>
        <meta charset="utf-8" />
        <style type="text/css">
            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
            }
            form {
                padding-top: 10px;
            }
        </style>
    </head>
    <body>
        <h2>Пользователи</h2>

<?php
    $connection = mysqli_connect("localhost", "root", "", "Test");

    if (!$connection)
    {
        die("Ошибка подключения: " . mysqli_connect_error());
    }

    $sqlQuery = "SELECT * FROM Users";

    if($resultSet = mysqli_query($connection, $sqlQuery))
    {
        $userCount = mysqli_num_rows($resultSet);

        echo "<p>Всего пользователей: $userCount</p>";
        echo "<table style=''><tr><th>ID</th><th>Имя</th><th>Фамилия</th><th>Пол</th><th>Возраст</th></tr>";

        foreach($resultSet as $user)
        {
            echo "<tr>";
                echo "<td>" . $user["id"] . "</td>";
                echo "<td>" . $user["name"] . "</td>";
                echo "<td>" . $user["surname"] . "</td>";
                echo "<td>" . ($user["sex"] ? "м" : "ж") . "</td>";
                echo "<td>" . $user["age"] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
        mysqli_free_result($resultSet);
    }
    else
    {
        echo "Ошибка: " . mysqli_error($connection);
    }

    mysqli_close($connection);
?>

    <!-- Форма добавления пользователя -->
    <form method="POST" action="save.php">
        <fieldset style="width: 20%">
            <legend>Добавление нового пользователя</legend>
            <ul>
                <li><p>Имя: <input type="text" name="name" /></p></li>
                <li><p>Фамилия: <input type="text" name="surname" /></p></li>
                <li><p>Пол:
                    <input type="radio" name="sex" value="1" /> муж
                    <input type="radio" name="sex" value="0" /> жен <br></li>
                </p>
                <li><p>Возраст: <input type="number" name="age" min="0" max="100" /></p></li>
            </ul>
            <input type="submit" name="submit" />
        </fieldset>
    </form>

    <!-- Форма удаления пользователя -->
    <form method="POST" action="delete.php">
        <fieldset style="width: 20%">
            <legend>Удаление пользователя</legend>
            <ul>
                <li><p>ID: <input type="number" name="id" min="0" /></p></li>
            </ul>
            <input type="submit" name="submit" />
        </fieldset>
    </form>

    </body>
</html>