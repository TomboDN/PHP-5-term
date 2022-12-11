<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<form enctype="multipart/form-data" action="/pdf/upload" method="POST">
    <div>
        <input type="hidden" name="MAX_FILE_SIZE" value="2000000"/>
        <br>
        <label class="custom-file-label" for="file_field"><?php switch ($_COOKIE["lang"]) {
                case 'ru':
                    echo "Выбрать файл:";
                    break;
                case 'en':
                    echo "Choose file:";
                    break;
        }?></label>
        <br>
        <input class="custom-file-input" id="file_field" name="userfile" type="file"/>
    </div>
    <br>
    <input class="btn btn-primary" type="submit" value="<?php switch ($_COOKIE["lang"]) {
        case 'ru':
            echo "Отправить файл";
            break;
        case 'en':
            echo "Send file";
            break;
    }?>"/>
</form>
<?php
$scanned_directory = array_diff(scandir('view/pdf/files'), array('..', '.'));
if (count($scanned_directory) > 0) {
    foreach ($scanned_directory as $file) {
        echo "<div class='card'><a class='card-body' href='view/pdf/files/" . $file . "'>" . $file . "</a></div>";
    }
}
?>