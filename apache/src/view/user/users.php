<style>span {
        margin: 10px;
    }</style>
<p><?php switch ($_COOKIE["lang"]) {
        case 'ru':
            echo "Список пользователей";
            break;
        case 'en':
            echo "User list";
            break;
    }?></p>
<table>
    <tr>
        <th><?php switch ($_COOKIE["lang"]) {
                case 'ru':
                    echo "ID";
                    break;
                case 'en':
                    echo "ID";
                    break;
            }?></th>
        <th><?php switch ($_COOKIE["lang"]) {
                case 'ru':
                    echo "Имя";
                    break;
                case 'en':
                    echo "Name";
                    break;
            }?></th>
        <th><?php switch ($_COOKIE["lang"]) {
                case 'ru':
                    echo "Пароль";
                    break;
                case 'en':
                    echo "Password";
                    break;
            }?></th>
        <th><?php switch ($_COOKIE["lang"]) {
                case 'ru':
                    echo "Роль";
                    break;
                case 'en':
                    echo "Role";
                    break;
            }?></th>
    </tr>
    <?php foreach ($users as $user) {
        echo "<tr><td>{$user['id']}</td><td>{$user['name']}</td><td>{$user['password']}</td><td>{$user['role']}</td></tr>";
    }
    ?>
</table>