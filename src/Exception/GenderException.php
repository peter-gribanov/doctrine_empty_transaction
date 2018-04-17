<?php
declare(strict_types=1);

namespace App\Exception;

final class GenderException extends \DomainException
{
    /**
     * @param string $value
     *
     * @return GenderException
     */
    public static function unsupportedValue(string $value): self
    {
        return new self(sprintf('Value "%s" is not supported gender', $value));
    }
}
