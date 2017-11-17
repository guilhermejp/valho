<?php

function translate_month($month){
    $translated_month = '';
    switch ($month) {
        case 2:
            $translated_month = 'Fevereiro';
            break;
        case 3:
            $translated_month = 'Março';
            break;
        case 4:
            $translated_month = 'Abril';
            break;
        case 5:
            $translated_month = 'Maio';
            break;
        case 6:
            $translated_month = 'Junho';
            break;
        case 7:
            $translated_month = 'Julho';
            break;
        case 8:
            $translated_month = 'Agosto';
            break;
        case 9:
            $translated_month = 'Setembro';
            break;
        case 10:
            $translated_month = 'Outubro';
            break;
        case 11:
            $translated_month = 'Novembro';
            break;
        case 12:
            $translated_month = 'Dezembro';
            break;

        default:
            $translated_month = 'Janeiro';
            break;
    }

    return $translated_month;
}

?>
