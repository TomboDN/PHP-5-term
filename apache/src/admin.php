<html lang="en">
<head>
    <title>Список пользователей</title>
    <link rel="stylesheet" href="style.css" type="text/css"/>
</head>
<body>
<h1>Таблица пользователей</h1>
<table>
    <tr>
        <th>Id</th>
        <th>Имя</th>
        <th>Пароль</th>
        <th>Роль</th>
    </tr>
    <?php include_once './api/config/database.php';
    $database = new Database();
    $connection = $database->getConnection();
    $result = $connection->query(/** @lang MySQL */ "SELECT * FROM users");
    foreach ($result as $row) {
        echo "<tr><td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['password']}</td><td>{$row['role']}</td></tr>";
    }
    $connection->close();
    ?>
</table>
</body>
</html>
