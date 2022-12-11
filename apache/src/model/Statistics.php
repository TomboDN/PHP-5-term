<?php

namespace model;

require_once 'vendor/autoload.php';


use core\FixtureCreator;
use core\Model;

class Statistics extends Model
{
    function addWaterMark($file, $id)
    {
        $im = imagecreatefrompng($file);
        $stamp = imagecreatefrompng("fixtures/stamp.png");
        imagealphablending($im, true);
        imagesavealpha($im, true);

        $marge_right = 10;
        $marge_bottom = 10;
        $sx = imagesx($stamp);
        $sy = imagesy($stamp);

        imagecopymerge($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp), 50);

        imagepng($im, $file);

        if ($id == 2) {
            $GLOBALS['state'] = true;
        }
    }

    function getCharts()
    {
        $fc = new FixtureCreator();
        $data = $fc->getUsers(60);

        $genderChart = array("male" => 0, "female" => 0);
        $ageChart = array("to18" => 0, "from18to30" => 0, "from30to50" => 0, "from50to80" => 0);
        $browsersBar = array("Chrome" => 0, "Firefox" => 0, "Opera" => 0, "InternetExplorer" => 0, "Safari" => 0, "MicrosoftEdge" => 0);

        foreach ($data as $row) {
            switch ($row['gender']) {
                case 'male':
                    $genderChart['male']++;
                    break;
                case 'female':
                    $genderChart['female']++;
                    break;
            }

            switch (true) {
                case $row['age'] < 18:
                    $ageChart['to18']++;
                    break;
                case $row['age'] < 30:
                    $ageChart['from18to30']++;
                    break;
                case $row['age'] < 50:
                    $ageChart['from30to50']++;
                    break;
                case $row['age'] <= 80:
                    $ageChart['from50to80']++;
                    break;
            }

            switch ($row['browser']) {
                case 'Chrome':
                    $browsersBar['Chrome']++;
                    break;
                case 'Firefox':
                    $browsersBar['Firefox']++;
                    break;
                case 'Opera':
                    $browsersBar['Opera']++;
                    break;
                case 'Internet Explorer':
                    $browsersBar['InternetExplorer']++;
                    break;
                case 'Safari':
                    $browsersBar['Safari']++;
                    break;
                case 'Microsoft Edge':
                    $browsersBar['MicrosoftEdge']++;
                    break;
            }
        }
        return array($genderChart, $ageChart, $browsersBar);
    }

    function getFixtures()
    {
        $arr = array();
        if (!empty($_POST['data'])) {
            $canvases = json_decode(stripslashes($_POST['data']));
            $t = 0;
            foreach ($canvases as $canvas) {

                $canvas = str_replace('data:image/png;base64,', '', $canvas);
                $canvas = str_replace(' ', '+', $canvas);
                $fileData = base64_decode($canvas);
                $fileName = "fixtures/photo_{$t}.png";
                file_put_contents($fileName, $fileData);
                $this->addWaterMark($fileName, $t);
                $t++;
            }
        }
        for ($i = 0; $i <= 2; $i++) {
            ob_start();
            $img = imagecreatefrompng("fixtures/photo_{$i}.png");
            $background = imagecolorallocate($img, 0, 0, 0);
            imagecolortransparent($img, $background);
            imagealphablending($img, false);
            imagesavealpha($img, true);
            imagepng($img);
            $arr[$i] = ob_get_contents();
            ob_end_clean();
        }

        return $arr;
    }
}