<?php

declare(strict_types=1);

namespace SimpleDataTableReader\Reader;

use SimpleDataTableReader\Iterator\CsvIterator;
use SimpleDataTableReader\Configuration;
use Symfony\Component\Yaml\Yaml;

/**
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
final class CsvReader extends AbstractReader
{
    public function __construct(string $file)
    {
        $csvConfiguration = Yaml::parseFile(Configuration::CONFIGURATION_FILE_PATH)['configuration']['csvReader'];
        $this->iterator = new CsvIterator(
            $file,
            $csvConfiguration['length'],
            $csvConfiguration['delimiter'],
            $csvConfiguration['enclosure'],
            $csvConfiguration['escape']
        );
    }

    /**
     * Rewind iterator.
     */
    public function setDelimiter(string $delimiter): self
    {
        $this->iterator->updateDelimiter($delimiter);

        return $this;
    }
}
