<?php
function moneyConvert(string $value)
{
    if (!is_numeric($value)) {
        throw new InvalidArgumentException("{$value} deve ser numérico");
    }

    $decimals = 2;

    $value = number_format($value, $decimals, ",", ".");

    if (strpos($value, '-') !== false) {
        return str_replace('-', '(', $value) . ')';
    }

    return $value;
}

function convertToDecimal($brl, $casasDecimais = 2) {
    // Se já estiver no formato USD, retorna como float e formatado
    if(preg_match('/^\d+\.{1}\d+$/', $brl))
        return (float) number_format($brl, $casasDecimais, '.', '');
    // Tira tudo que não for número, ponto ou vírgula
    $brl = preg_replace('/[^\d\.\,]+/', '', $brl);
    // Tira o ponto
    $decimal = str_replace('.', '', $brl);
    // Troca a vírgula por ponto
    $decimal = str_replace(',', '.', $decimal);
    return (float) number_format($decimal, $casasDecimais, '.', '');
}