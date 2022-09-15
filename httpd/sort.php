<?php
function quickSort(&$arr): void
{
    qckSort($arr, 0, count($arr)-1);
}
function qckSort(&$arr, $low, $high): void
{
    $i = $low;
    $j = $high;
    $middle =  $arr[ (int) (( $low + $high ) / 2) ];
    do {
        while($arr[$i] < $middle) ++$i;
        while($arr[$j] > $middle) --$j;
            if($i <= $j){
                $temp = $arr[$i];
                $arr[$i] = $arr[$j];
                $arr[$j] = $temp;
                $i++; $j--;
            }
        }
    while($i < $j);

    if($low < $j){
        qckSort($arr, $low, $j);
    }

    if($i < $high){
        qckSort($arr, $i, $high);
    }
}

$array = explode(',', $_POST['array']);
quickSort($array);

echo '<pre>';
print_r($array);
echo '</pre>';