<?php

namespace HuR\Snippets;

class Helper
{
    public static function snippetTypes(): array
    {
        return [
            __('Annuity calculator', 'hur-snippets') => 'calcAnnuityWhiteLabel',
            __('Credit calculator', 'hur-snippets') => 'embedCredit',
            __('Variant S', 'hur-snippets') => 'embedSmall',
            __('Variant M', 'hur-snippets') => 'embedMedium',
            __('Variant L', 'hur-snippets') => 'embedLarge',
            __('Custom configuration', 'hur-snippets') => '@custom'
        ];
    }

    public static function isZip(string $value): bool{
        return (bool)preg_match('~\d{4,5}~', $value);
    }

    public static function floatFromString($value): float {
        if (is_float($value)){
            return $value;
        }
        if(!is_string($value)){
            return (float)0;
        }
        $value = preg_replace('~[^0-9.]~', '', str_replace([".", ","], ["", "."], $value));
        return (float)$value;
    }

    public static function removeEmpty(array $array): array
    {
        foreach ($array as $key => $value) {
            if (empty($value) && $value !== '0' && $value !== 0) {
                unset($array[$key]);
            }
        }

        return $array;
    }
}
