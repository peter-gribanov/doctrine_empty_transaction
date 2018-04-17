<?php
declare(strict_types=1);

namespace App\Exception;

use App\Entity\UserId;

final class UserNotFoundException extends \DomainException
{
    /**
     * @param UserId $id
     *
     * @return UserNotFoundException
     */
    public static function withId(UserId $id): self
    {
        return new self(sprintf('Not found user with id "%d".', $id->id()));
    }
}
