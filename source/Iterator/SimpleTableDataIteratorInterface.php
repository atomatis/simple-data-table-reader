<?php

declare(strict_types=1);

namespace SimpleDataTableReader\Iterator;

/**
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
interface SimpleTableDataIteratorInterface extends \Iterator
{
    /** Header array */
    public function getHeader(): array;
}
