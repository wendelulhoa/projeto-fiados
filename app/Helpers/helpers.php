<?php

use Illuminate\Support\Carbon;

/* Faz a conversão para moeda brasileira. */ 
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

/* Converte para decimal. */ 
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

/* Pega o nome do Mês*/ 
function getMonth($month) {
    $monthName = "";
    switch ($month) {
        case "01":
            $monthName = 'Jan';
            break;
        case "02":
            $monthName = 'Fev';
            break;
        case "03":
            $monthName = 'Mar';
            break;
        case "04":
            $monthName = 'Abr';
            break;
        case "05":
            $monthName = 'Mai';
            break;
        case "06":
            $monthName = 'Jun';
            break;
        case "07":
            $monthName = 'Jul';
            break;
        case "08":
            $monthName = 'Ago';
            break;
        case "09":
            $monthName = 'Set';
            break;
        case "10":
            $monthName = 'Out';
            break;
        case "11":
            $monthName = 'Nov';
            break;
        case "12":
            $monthName = 'Dez';
            break;
    }

    return $monthName;
}

/* Pega o mês atual. */ 
function getCurrentMonth() {
    return Carbon::now()->format('m');
}

/* Pega o mês atual. */ 
function getCurrentYear() {
    return Carbon::now()->format('Y');
}

/**
 * Retorna o CPF formatado
 * CNPJ no formato XX.XXX.XXX/XXXX-XX
 * CPF no formato XXX.XXX.XXX-XX
 *
 * @param string|int $number Número do CPF a ser formatado (ele pode ser nulo pelo fato de que o campo
 * cpf não é obrigatório)
 * @return string|null Uma string com o CPF formatado ou null caso não seja passado o parâmetro
 */
function formatCpf($number = null)
{
    $number = trim($number);
    if (is_null($number) || $number == "") {
        return null;
    }

    return $number = substr($number, 0, 3) . '.' . substr($number, 3, 3) . '.' . substr($number, 6, 3) . '-' . substr($number, 9, 2);
}

/**
 * Remove os caracteres de formatação do CPF
 *
 * @param string|int $number Número do CPF a ser formatado (ele pode ser nulo pelo fato de que o campo
 * cpfcnpj não é obrigatório)
 * @return string|null Uma string com o CPF desformatado ou null caso não seja passado o parâmetro
 */
function unformatedCpf($number = null)
{
    $number = trim($number);
    if (is_null($number) || $number == "") {
        return null;
    }
    return $number = str_replace(['.', '/', '-'], "", $number);
}