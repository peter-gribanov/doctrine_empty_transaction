<?php
declare(strict_types=1);

namespace App\Entity;

final class Social
{
    /**
     * @var int|null
     */
    private $facebook_id;

    /**
     * @var int|null
     */
    private $google_id;

    /**
     * @var int|null
     */
    private $twitter_id;

    /**
     * @param int|null $facebook_id
     * @param int|null $google_id
     * @param int|null $twitter_id
     */
    public function __construct(?int $facebook_id = null, ?int $google_id = null , ?int $twitter_id = null)
    {
        $this->facebook_id = $facebook_id;
        $this->google_id = $google_id;
        $this->twitter_id = $twitter_id;
    }

    /**
     * @return int|null
     */
    public function facebookId(): ?int
    {
        return $this->facebook_id;
    }

    /**
     * @return int|null
     */
    public function googleId(): ?int
    {
        return $this->google_id;
    }

    /**
     * @return int|null
     */
    public function twitterId(): ?int
    {
        return $this->twitter_id;
    }
}
