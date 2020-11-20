<?php

declare(strict_types=1);

namespace SimpleDataTableReader\Iterator;

/**
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
abstract class AbstractIterator implements SimpleTableDataIteratorInterface
{
    protected $iterator;

    protected $header = [];

    protected $headerSize;

    protected $offset = 0;

    /** @{inheritdoc} */
    public function getHeader(): array
    {
        return $this->header;
    }

    /** @{inheritdoc} */
    public function key(): int
    {
        return $this->offset;
    }
}
