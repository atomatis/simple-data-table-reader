<?php

declare(strict_types=1);

namespace SimpleDataTableReader\Iterator;

/**
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
final class Row
{
    private $rowValues;

    public function __construct(array $header, array $values) {
        $this->rowValues = array_combine($header, $values);
    }

    public function __invoke(): array
    {
        return $this->getValues();
    }

    public function getValues(): array
    {
        return $this->rowValues;
    }

    public function get(string $index)
    {
        return $this->rowValues[$index] ?? null;
    }

    public function set(string $index, $value)
    {
        $this->rowValues[$index] = $value;

        return $this;
    }
}
