<?php
if (!isset($_SESSION['count'])) {
    $_SESSION['count'] = 1;
} else {
    $_SESSION['count']++;
}
switch ($_COOKIE["lang"]) {
    case 'ru':
        echo "<p>Число просмотров этой страницы в этой сессии: " . $_SESSION['count'] . "</p>";
        break;
    case 'en':
        echo "<p>Amount of this page's views in this session: " . $_SESSION['count'] . "</p>";
        break;
}