<?php
function formatNumber($num) {
    if($num > 999 && $num <= 999999) {
        return number_format($num/1000, 1) . 'k';
    } else if($num > 999999) {
        return number_format($num/1000000, 1) . 'M';
    } else {
        return $num;
    }
}


$numero=2500;
$resultado = formatNumber($numero);
echo $resultado;