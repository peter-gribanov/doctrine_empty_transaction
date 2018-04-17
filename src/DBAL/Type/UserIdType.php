<?php
declare(strict_types=1);

namespace App\DBAL\Type;

use App\Entity\UserId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;

final class UserIdType extends Type
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
     * @return UserId|null
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if ($value === null || $value instanceof UserId) {
            return $value;
        }

        try {
            $vo = new UserId($value);
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
        return 'UserId';
    }
}
