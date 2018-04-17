<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\UserId;
use App\Entity\UserIdGenerator;

class UIDUserIdGenerator implements UserIdGenerator
{
    /**
     * @throws \Exception
     *
     * @return UserId
     */
    public function generate(): UserId
    {
        $uid = random_bytes(8);
        $uid = base64_encode($uid);
        $uid = str_replace(['=', '+', '/'], ['', '-', '_'], $uid);

        return new UserId($uid);
    }
}
