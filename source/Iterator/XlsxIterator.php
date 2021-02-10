<?php

declare(strict_types=1);

namespace SimpleDataTableReader\Iterator;

use SimpleDataTableReader\CaseConverter\SnakeCaseConverter;
use SimpleDataTableReader\Exception\DuplicateHeaderValueException;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\RowCellIterator;

/**
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
final class XlsxIterator extends AbstractIterator
{
    public function __construct(string $file)
    {
        $spreadsheet = IOFactory::load($file);
        $this->iterator = $spreadsheet->getActiveSheet()->getRowIterator();
        $this->generateHeader($this->iterator->current()->getCellIterator());
    }

    /** @{inheritdoc} */
    public function current(): Row
    {
        $values = [];

        foreach ($this->iterator->current()->getCellIterator() as $cell) {
            $values[] = $cell->getValue();
        }

        $values = array_slice($values, 0, $this->headerSize);

        return new Row($this->header, $values);
    }

    /** @{inheritdoc} */
    public function valid(): bool
    {
        $allEmpty = true;

        foreach ($this->iterator->current()->getCellIterator() as $cell) {
            if (null !== $cell->getValue()) {
                $allEmpty = false;
            }
        }

        return $allEmpty ? false : $this->iterator->valid();
    }

    /** @{inheritdoc} */
    public function next(): void
    {
        $this->offset++;
        $this->iterator->next();
    }

    /** @{inheritdoc} */
    public function rewind(): void
    {
        $this->iterator->rewind();
        $this->offset = 0;
        $this->iterator->next();
    }

    private function generateHeader(RowCellIterator $cellIterator): void
    {
        foreach ($cellIterator as $cell) {
            $originalValue = $cell->getValue();

            // Avoid extra void header column.
            if (null === $originalValue) {
                break;
            }

            $headerValue = SnakeCaseConverter::fromString($originalValue);
            $headerValue = trim($headerValue);

            // Block same value header.
            if (in_array($headerValue, $this->header)) {
                throw DuplicateHeaderValueException::create($originalValue);
            }

            // TW: Blind for true empty lasts columns header
            if ('' === $headerValue) {
                break;
            }

            $this->header[] = $headerValue;
        }

        if (0 === count($this->header)) {
            throw new \Exception('No headers values found.');
        }

        $this->headerSize = count($this->header);
        $this->next();
    }
}
