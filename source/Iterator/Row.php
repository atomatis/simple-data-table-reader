<?php

declare(strict_types=1);

namespace SimpleDataTableReader\Iterator;

/**
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
final class Row
{
    private $rowValues;

    private static $_instance = null;

    private function __construct() {
    }

    public function __invoke()
    {
        return $this->rowValues;
    }

    public static function getInstance() {

        if(is_null(self::$_instance)) {
            self::$_instance = new Row();
        }

        return self::$_instance;
    }

    public function setRowValues(array $header, array $values): void
    {
        $this->rowValues = array_combine($header, $values);
    }

    /**
     * @param string $index
     *
     * @return mixed
     */
    public function get(string $index)
    {
        return $this->rowValues[$index] ?? null;
    }
}
