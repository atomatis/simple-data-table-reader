<?php

declare(strict_types=1);

namespace SimpleDataTableReader\Exception;

/**
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
final class UnavailableFileTypeExtension extends \Exception
{
    public function __construct(string $extension, array $extensionAvailable)
    {
        $message = sprintf('No reader found for extension "%s". Extension available: %s', $extension, implode(', ', $extensionAvailable));

        parent::__construct($message);
    }

    public static function create(string $extension, array $extensionAvailable): self
    {
        return new self($extension, $extensionAvailable);
    }
}
