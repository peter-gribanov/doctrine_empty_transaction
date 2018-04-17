<?php
declare(strict_types=1);

namespace App\DBAL\Type;

use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;

class DateTimeImmutableType extends Type
{
    /**
     * @throws DBALException
     *
     * @param array            $fieldDeclaration
     * @param AbstractPlatform $platform
     *
     * @return string
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return $platform->getDateTimeTypeDeclarationSQL($fieldDeclaration);
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
     * @param int              $value
     * @param AbstractPlatform $platform
     *
     * @return \DateTimeImmutable|null
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if ($value === null || $value instanceof \DateTimeImmutable) {
            return $value;
        }

        $val = \DateTimeImmutable::createFromFormat($platform->getDateTimeFormatString(), $value);

        if (!$val) {
            $val = date_create_immutable($value);
        }

        if (!$val) {
            throw ConversionException::conversionFailedFormat($value, $this->getName(), $platform->getDateTimeFormatString());
        }

        return $val;
    }

    /**
     * @param \DateTimeImmutable $value
     * @param AbstractPlatform   $platform
     *
     * @return mixed
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value instanceof \DateTimeImmutable ? $value->format($platform->getDateTimeFormatString()) : null;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'DateTimeImmutable';
    }
}
