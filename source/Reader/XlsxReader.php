<?php

declare(strict_types=1);

namespace SimpleDataTableReader\Reader;

use SimpleDataTableReader\Iterator\XlsxIterator;

/**
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
final class XlsxReader extends AbstractReader
{
    public function __construct(string $file)
    {
        $this->iterator = new XlsxIterator($file);
    }
}
