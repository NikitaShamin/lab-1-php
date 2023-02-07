<!DOCTYPE html>
<html>
    <head>
        <title>LAB_1</title>
        <meta charset="utf-8" />
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
        echo "<table><tr><th>ID</th><th>Имя</th><th>Фамилия</th><th>Пол</th><th>Возраст</th></tr>";

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

    </body>
</html>