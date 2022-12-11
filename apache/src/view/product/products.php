<style>span { margin: 10px; }</style>
<p><?php switch ($_COOKIE["lang"]) {
        case 'ru':
            echo "Меню";
            break;
        case 'en':
            echo "Menu";
            break;
    }?></p>
<table>
    <tr>
        <th><?php switch ($_COOKIE["lang"]) {
                case 'ru':
                    echo "Название";
                    break;
                case 'en':
                    echo "Name";
                    break;
            }?></th>
        <th><?php switch ($_COOKIE["lang"]) {
                case 'ru':
                    echo "Объём";
                    break;
                case 'en':
                    echo "Volume";
                    break;
            }?></th>
        <th><?php switch ($_COOKIE["lang"]) {
                case 'ru':
                    echo "Цена";
                    break;
                case 'en':
                    echo "Price";
                    break;
            }?></th>
    </tr>
    <?php foreach ($products as $product) {
        echo "<tr><td>{$product['name']}</td><td>{$product['volume']}</td><td>{$product['price']}</td></tr>";
    }
    ?>
</table>