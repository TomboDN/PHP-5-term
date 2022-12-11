<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title; ?></title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.1/css/bootstrap.min.css" />
    <script src="https://kit.fontawesome.com/c4cafcfd34.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css"/>
    <?php if (isset($_COOKIE['theme'])) echo '<link rel="stylesheet" href="css/' . $_COOKIE['theme'] . '.css" type="text/css">' ?>
</head>
<body>
<?php echo $content; ?>
</body>
</html>