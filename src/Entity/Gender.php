<?php
declare(strict_types=1);

namespace App\Entity;

use App\Exception\GenderException;

/**
 * @method static Gender female()
 * @method static Gender male()
 * @method static Gender unknown()
 */
final class Gender
{
    private const VALUES = [
        'female',
        'male',
        'unknown',
    ];

    /**
     * @var string
     */
    private $value = '';

    /**
     * @var Gender[]
     */
    private static $instances = [];

    /**
     * @param string $value
     */
    public function __construct(string $value)
    {
        if (!in_array($value, self::VALUES, true)) {
            throw GenderException::unsupportedValue($value);
        }

        $this->value = $value;
    }

    /**
     * @param string $value
     *
     * @return Gender
     */
    public static function byValue(string $value): self
    {
        if (!array_key_exists($value, self::$instances)) {
            self::$instances[$value] = new self($value);
        }

        return self::$instances[$value];
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }

    /**
     * @return Gender[]
     */
    public static function values(): array
    {
        $values = [];
        foreach (self::VALUES as $value) {
            $values[$value] = self::byValue($value);
        }

        return $values;
    }

    /**
     * @param Gender $gender
     *
     * @return bool
     */
    public function equals(Gender $gender): bool
    {
        return $this->value === $gender->value;
    }

    /**
     * @param string $method
     * @param array  $arguments
     *
     * @return Gender
     */
    public static function __callStatic(string $method, array $arguments = []): self
    {
        return self::byValue($method);
    }
}
