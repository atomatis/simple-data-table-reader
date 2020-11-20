<?php

declare(strict_types=1);

namespace SimpleDataTableReader\Reader;

use SimpleDataTableReader\Iterator\SimpleTableDataIteratorInterface;

/**
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
abstract class AbstractReader implements SimpleReaderInterface
{
    protected $iterator;

    /** @{inheritdoc} */
    public function getIterator(): SimpleTableDataIteratorInterface
    {
        return $this->iterator;
    }

    /** @{inheritdoc} */
    public function getHeader(): array
    {
        return $this->iterator->getHeader();
    }

    /** @{inheritdoc} */
    public function getOffset(): int
    {
        return $this->iterator->key();
    }
}
