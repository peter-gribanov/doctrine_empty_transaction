<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\Password;
use App\Entity\PasswordEncoder;

class HashPasswordEncoder implements PasswordEncoder
{
    /**
     * @throws \Exception
     *
     * @param string $plain_password
     *
     * @return Password
     */
    public function encode(string $plain_password): Password
    {
        return new Password(password_hash($plain_password, PASSWORD_BCRYPT, ['cost' => 12]));
    }

    /**
     * @param Password $password
     * @param string   $plain_password
     *
     * @return bool
     */
    public function equal(Password $password, string $plain_password): bool
    {
        return password_verify($plain_password, $password->password());
    }
}
