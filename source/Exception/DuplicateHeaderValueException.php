<?php

declare(strict_types=1);

namespace SimpleDataTableReader\Exception;

/**
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
final class DuplicateHeaderValueException extends \Exception
{
    public function __construct(string $headerValue)
    {
        $message = sprintf('File header values must be unique. "%s" is not. (Header value space and special character are ignored.)', $headerValue);

        parent::__construct($message);
    }

    public static function create(string $headerValue): self
    {
        return new self($headerValue);
    }
}
