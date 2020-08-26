<?php

namespace HuR\Snippets;

class Helper
{
    public static function snippetTypes(): array
    {
        return [
            __('Credit calculator', 'hur-snippets') => 'embedCredit',
            __('Variant S', 'hur-snippets') => 'embedSmall',
            __('Variant M', 'hur-snippets') => 'embedMedium',
            __('Variant L', 'hur-snippets') => 'embedLarge',
            __('Construction financing FAQ', 'hur-snippets') => 'embedFaq'
        ];
    }

    public static function removeEmpty(array $array): array
    {
        foreach ($array as $key => $value) {
            if (empty($value)) {
                unset($array[$key]);
            }
        }

        return $array;
    }
}
