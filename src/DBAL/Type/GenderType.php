<?php
declare(strict_types=1);

namespace App\DBAL\Type;

use App\Entity\Gender;
use Doctrine\DBAL\Platforms\AbstractPlatform;

final class GenderType extends EnumType
{
    /**
     * @param Gender|null   $value
     * @param AbstractPlatform $platform
     *
     * @return string|null
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (null === $value) {
            return null;
        }

        $this->valueMustBeInstanceOf($value, Gender::class);

        return $value->value();
    }

    /**
     * @param string           $value
     * @param AbstractPlatform $platform
     *
     * @return Gender
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return !is_null($value) ? Gender::byValue($value) : null;
    }

    /**
     * @return string[]
     */
    protected function getValues()
    {
        $values = [];
        foreach (Gender::values() as $value) {
            $values[] = $value->value();
        }

        return $values;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'Gender';
    }
}
