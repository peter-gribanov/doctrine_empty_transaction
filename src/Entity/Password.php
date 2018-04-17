<?php
declare(strict_types=1);

namespace App\Entity;

final class Password
{
    /**
     * @var string
     */
    private $password = '';

    /**
     * @param string $encoded_password
     */
    public function __construct(string $encoded_password)
    {
        $this->password = $encoded_password;
    }

    /**
     * @return string
     */
    public function password(): string
    {
        return $this->password;
    }
}
