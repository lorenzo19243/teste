<?php

function formata_dinheiro($valor) {
    $valor = number_format($valor, 2, ',', '');
    return "R$ " . $valor;
}

function mostraMes($m) {
    switch ($m) {
        case '01': $mes = "JANEIRO";
            break;
        case '02': $mes = "FEVEREIRO";
            break;
        case '03': $mes = "MARÇO";
            break;
        case '04':  $mes = "ABRIL";
            break;
        case '05': $mes = "MAIO";
            break;
        case '06': $mes = "JUNHO";
            break;
        case '07': $mes = "JULHO";
            break;
        case '08': $mes = "AGOSTO";
            break;
        case '09': $mes = "SETEMBRO";
            break;
        case '10': $mes = "OUTUBRO";
            break;
        case '11': $mes = "NOVEMBRO";
            break;
        case '12': $mes = "DEZEMBRO";
            break;
        case '13': $mes = "TOTAL ANO";
            break;
    }
    return $mes;
}

?>

