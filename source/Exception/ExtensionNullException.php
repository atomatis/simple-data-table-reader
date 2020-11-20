<?php

declare(strict_types=1);

namespace SimpleDataTableReader\Exception;

/**
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
final class ExtensionNullException extends \Exception
{
    public function __construct(string $filename)
    {
        $message = sprintf('Can\'t guess file name extension. ("%s")', $filename);

        parent::__construct($message);
    }

    public static function create(string $filename): self
    {
        return new self($filename);
    }
}
