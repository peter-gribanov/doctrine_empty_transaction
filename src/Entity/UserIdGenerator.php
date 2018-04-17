<?php
declare(strict_types=1);

namespace App\Entity;

interface UserIdGenerator
{
    /**
     * @return UserId
     */
    public function generate(): UserId;
}
