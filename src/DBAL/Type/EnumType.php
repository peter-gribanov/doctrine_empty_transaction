<?php
declare(strict_types=1);

namespace App\DBAL\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Platforms\PostgreSqlPlatform;
use Doctrine\DBAL\Platforms\SqlitePlatform;
use Doctrine\DBAL\Platforms\SQLServerPlatform;
use Doctrine\DBAL\Types\Type;

abstract class EnumType extends Type
{
    /**
     * @param array            $fieldDeclaration
     * @param AbstractPlatform $platform
     *
     * @return string
     */
    public function getSqlDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        $values = $this->getValues();
        $values = $values ? '"'.implode('", "', $values).'"' : '';

        if ($platform instanceof SqlitePlatform) {
            return sprintf('TEXT CHECK(%s IN (%s))', $fieldDeclaration['name'], $values);
        }

        if ($platform instanceof PostgreSqlPlatform || $platform instanceof SQLServerPlatform) {
            return sprintf('VARCHAR(255) CHECK(%s IN (%s))', $fieldDeclaration['name'], $values);
        }

        return sprintf('ENUM(%s)', $values);
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
     * @return string[]
     */
    abstract protected function getValues();

    /**
     * @param string $value
     * @param string $class
     */
    protected function valueMustBeInstanceOf($value, $class)
    {
        if (!($value instanceof $class)) {
            throw new \InvalidArgumentException(
                sprintf('Value "%s" must be instance of "%s" for ENUM "%s".', $value, $class, $this->getName())
            );
        }
    }
}
