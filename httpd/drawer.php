<?php
$num = $_GET['num'] ?? 1;
$width = $num << 8;
$height = $num << 6;
$radius = $num << 2;
$center = $num << 2;
if ($num % 6 == 0) {
    $color = "red";
} elseif ($num % 6 == 1) {
    $color = "green";
} elseif ($num % 6 == 2) {
    $color = "blue";
} elseif ($num % 6 == 3) {
    $color = "yellow";
} elseif ($num % 6 == 4) {
    $color = "purple";
} elseif ($num % 6 == 5) {
    $color = "orange";
} else {
    $color = "violet";
}
?>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Drawer</title>
</head>
<body>
<div class="svg">
    <svg width="800" height="800">
        <?php
        if ($num% 2 == 0) {
            echo "<circle cx='$center' cy='$center' r='$radius' fill='$color'/>";
        } else
            echo "<rect width='$width' height='$height' fill='$color'/>";
        ?>
    </svg>
</div>
</body>
</html>
