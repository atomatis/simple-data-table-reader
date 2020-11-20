<?php

declare(strict_types=1);

namespace SimpleDataTableReader\CaseConverter;

/**
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
final class SnakeCaseConverter
{
    // non-alpha and non-numeric characters become spaces
    public static function fromString($string, array $noStrip = [])
    {
        $string = preg_replace('/[^a-z0-9' . implode("", $noStrip) . ']+/i', ' ', $string);
        $string = trim($string);
        $string = str_replace(" ", "_", $string);
        $string = strtolower($string);

        return $string;
    }
}
