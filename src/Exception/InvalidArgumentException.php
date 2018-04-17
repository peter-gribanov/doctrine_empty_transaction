<?php
declare(strict_types=1);

namespace App\Exception;

final class InvalidArgumentException extends \DomainException
{
    /**
     * @return InvalidArgumentException
     */
    public static function emptyEmail(): self
    {
        return new self('Email is required for create new user.');
    }

    /**
     * @param string $email
     *
     * @return InvalidArgumentException
     */
    public static function invalidEmail(string $email): self
    {
        return new self(sprintf('Email "%s" is not correct for create new user.', $email));
    }

    /**
     * @return InvalidArgumentException
     */
    public static function emptyPassword(): self
    {
        return new self('User password must not be empty.');
    }

    /**
     * @return InvalidArgumentException
     */
    public static function passwordNotMatch(): self
    {
        return new self('Password doesn\'t match the current user password.');
    }
}
