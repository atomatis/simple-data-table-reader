<?php

declare(strict_types=1);

namespace SimpleDataTableReader\Reader;

use SimpleDataTableReader\Exception\ExtensionNullException;
use SimpleDataTableReader\Exception\UnavailableFileTypeExtension;

/**
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
final class SimpleReaderFactory
{
    public static function getAvailableReader(): array
    {
        return [
          'csv' => CsvReader::class,
          'xlsx' => XlsxReader::class,
        ];
    }

    public static function createTableDataReader(string $file, ?string $extension = null): SimpleReaderInterface
    {
        $pathInfo = pathinfo($file);
        $extension = $extension ?? ($pathInfo['extension'] ?? null);

        if (null === $extension) {
            throw ExtensionNullException::create($pathInfo['filename']);
        }

        if (!in_array($extension, array_keys(self::getAvailableReader()))) {
            throw UnavailableFileTypeExtension::create($extension, array_values(self::getAvailableReader()));
        }

        $readerClass = self::getAvailableReader()[$extension];

        return new $readerClass($file);
    }
}
