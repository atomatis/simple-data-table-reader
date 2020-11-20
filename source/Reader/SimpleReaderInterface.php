<?php

declare(strict_types=1);

namespace SimpleDataTableReader\Reader;

use SimpleDataTableReader\Iterator\SimpleTableDataIteratorInterface;

/**
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
interface SimpleReaderInterface
{
    /** Table data row iterator. */
    public function getIterator(): SimpleTableDataIteratorInterface;

    /** Table data header. */
    public function getHeader(): array;

    /** Table data row position (start at 1) */
    public function getOffset(): int;
}
