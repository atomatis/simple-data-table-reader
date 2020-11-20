<?php

declare(strict_types=1);

namespace SimpleDataTableReader\Iterator;

use SimpleDataTableReader\CaseConverter\SnakeCaseConverter;
use SimpleDataTableReader\Exception\DuplicateHeaderValueException;

/**
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
final class CsvIterator extends AbstractIterator
{
    private $file;

    private $handle;

    private $length;

    private $delimiter;

    private $enclosure;

    private $escape;

    private $row;

    public function __construct(string $file, $length = 0, $delimiter = ',', $enclosure = '"', $escape = '\\')
    {
        $this->handle = fopen($file, 'r');
        $this->length = $length;
        $this->delimiter = $delimiter === 'auto' ? $this->guessDelimiter() : $delimiter;
        $this->enclosure = $enclosure;
        $this->escape = $escape;
        $this->file = $file;
        $this->generateHeader();
    }

    /** @{inheritdoc} */
    public function current(): Row
    {
        $row = Row::getInstance();
        $values = array_slice($this->row, 0, $this->headerSize);
        $row->setRowValues($this->header, $values);

        return $row;
    }

    /** @{inheritdoc} */
    public function valid(): bool
    {
        if (!$this->row) {
            fclose($this->handle);

            return false;
        }

        return true;
    }

    /** @{inheritdoc} */
    public function next(): void
    {
        $this->offset++;
        $this->row = fgetcsv($this->handle, $this->length, $this->delimiter, $this->enclosure, $this->escape);
    }

    /** @{inheritdoc} */
    public function rewind(): void
    {
        if (!isset($handle)) {
            $this->handle = fopen((string) $this->file, 'r');
        }

        rewind($this->handle);
        // Skip header
        $this->next();
        $this->next();
    }

    public function updateDelimiter(string $delimiter): void
    {
        $this->delimiter = $delimiter;
        rewind($this->handle);
        $this->generateHeader();
    }

    private function generateHeader(): void
    {
        $this->next();

        foreach ($this->row as $value) {
            $originalValue = $value;
            $headerValue = SnakeCaseConverter::fromString($originalValue);
            $headerValue = trim($headerValue);

            // Block same value header.
            if (in_array($headerValue, $this->header)) {
                throw DuplicateHeaderValueException::create($originalValue);
            }

            $this->header[] = $headerValue;
        }

        $this->headerSize = count($this->header);
        $this->next();
    }

    private function guessDelimiter(): string
    {
        $string = fgets($this->handle);
        rewind($this->handle);

        return substr_count($string, ';') > substr_count($string, ',') ? ';' : ',';
    }
}
