<?php

namespace AlmeidaFranci\LaravelValidatorExtender;

class ValidatorExtension
{
    public static function validatePhone($attribute, $value, $parameters, $validator)
    {
        return self::validateCellphone($attribute, $value, $parameters, $validator)
            || self::validateLandline($attribute, $value, $parameters, $validator);
    }

    public static function validateCellphone($attribute, $value, $parameters, $validator)
    {
        return preg_match('/^\(\d{2}\)\s9\d{4}-\d{4}$/', $value) === 1;
    }

    public static function validateLandline($attribute, $value, $parameters, $validator)
    {
        return preg_match('/^\(\d{2}\)\s?\d{4,5}-\d{4}$/', $value) === 1;
    }

    public static function validateCpf($attribute, $value, $parameters, $validator)
    {
        if (preg_match('/^\d{3}\.\d{3}\.\d{3}-\d{2}$/', $value) !== 1) {
            return false;
        }

        $c = preg_replace('/\D/', '', $value);
        if (strlen($c) != 11 || preg_match("/^{$c[0]}{11}$/", $c)) {
            return false;
        }
        for ($s = 10, $n = 0, $i = 0; $s >= 2; $n += $c[$i++] * $s--);
        if ($c[9] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }
        for ($s = 11, $n = 0, $i = 0; $s >= 2; $n += $c[$i++] * $s--);
        if ($c[10] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }
        return true;
    }

    public static function validateCnpj($attribute, $value, $parameters, $validator)
    {
        if (preg_match('/^\d{2}\.\d{3}\.\d{3}\/\d{4}-\d{2}$/', $value) !== 1) {
            return false;
        }

        $c = preg_replace('/\D/', '', $value);
        $b = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        if (strlen($c) != 14) {
            return false;
        }
        // Remove sequências repetidas como "111111111111"
        // https://github.com/LaravelLegends/pt-br-validator/issues/4
        elseif (preg_match("/^{$c[0]}{14}$/", $c) > 0) {
            return false;
        }
        for ($i = 0, $n = 0; $i < 12; $n += $c[$i] * $b[++$i]);
        if ($c[12] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }
        for ($i = 0, $n = 0; $i <= 12; $n += $c[$i] * $b[$i++]);
        if ($c[13] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }
        return true;
    }

    public static function validateZip($attribute, $value, $parameters, $validator)
    {
        return preg_match('/^\d{5}-\d{3}$/', $value) === 1;
    }
}