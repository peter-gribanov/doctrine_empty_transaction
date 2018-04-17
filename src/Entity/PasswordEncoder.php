<?php
declare(strict_types=1);

namespace App\Entity;

interface PasswordEncoder
{
    /**
     * @param string $plain_password
     *
     * @return Password
     */
    public function encode(string $plain_password): Password;

    /**
     * @param Password $password
     * @param string   $plain_password
     *
     * @return bool
     */
    public function equal(Password $password, string $plain_password): bool;
}
