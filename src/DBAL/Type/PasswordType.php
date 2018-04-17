<?php
declare(strict_types=1);

namespace App\DBAL\Type;

use App\Entity\Password;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;

final class PasswordType extends Type
{
    /**
     * @param array            $fieldDeclaration
     * @param AbstractPlatform $platform
     *
     * @return string
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return $platform->getIntegerTypeDeclarationSQL($fieldDeclaration);
    }

    /**
     * @param AbstractPlatform $platform
     *
     * @return bool
     */
    public function requiresSQLCommentHint(AbstractPlatform $platform)
    {
        return true;
    }

    /**
     * @throws ConversionException
     *
     * @param mixed            $value
     * @param AbstractPlatform $platform
     *
     * @return Password|null
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if ($value === null || $value instanceof Password) {
            return $value;
        }

        try {
            $vo = new Password($value);
        } catch (\Exception $e) {
            throw ConversionException::conversionFailedFormat(
                $value,
                $this->getName(),
                $platform->getDateTimeFormatString()
            );
        }

        return $vo;
    }

    /**
     * @throws ConversionException
     *
     * @param mixed            $value
     * @param AbstractPlatform $platform
     *
     * @return mixed
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        $value = $this->convertToPHPValue($value, $platform);

        return $value !== null ? (string) $value : null;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'Password';
    }
}
