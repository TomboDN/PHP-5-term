<?php
echo $result."<br>";
switch ($_COOKIE["lang"]) {
    case 'ru':
        echo "<a href='/pdf'>Вернуться к просмотру pdf файлов</a>";
        break;
    case 'en':
        echo "<a href='/pdf'>Return to pdf view</a>";
        break;
}
