<?php
declare(strict_types=1);

namespace App\Entity;

interface UserRepository
{
    /**
     * @param UserId $id
     *
     * @return User
     */
    public function get(UserId $id): User;

    /**
     * @param User $user
     */
    public function remove(User $user): void;
}
