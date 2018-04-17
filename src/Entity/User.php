<?php
declare(strict_types=1);

namespace App\Entity;

use App\Exception\InvalidArgumentException;

final class User
{
    /**
     * @var UserId
     */
    private $id;

    /**
     * @var string
     */
    private $email;

    /**
     * @var Password
     */
    private $password;

    /**
     * @var Social
     */
    private $social;

    /**
     * @var Profile
     */
    private $profile;

    /**
     * @param UserIdGenerator $generator
     * @param string          $email
     * @param string          $plain_password
     * @param PasswordEncoder $password_encoder
     */
    public function __construct(
        UserIdGenerator $generator,
        string $email,
        string $plain_password,
        PasswordEncoder $password_encoder
    ) {
        if ($email === '') {
            throw InvalidArgumentException::emptyEmail();
        }

        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            throw InvalidArgumentException::invalidEmail($email);
        }

        $this->id = $generator->generate();
        $this->email = $email;
        $this->password = $password_encoder->encode($plain_password);
        $this->social = new Social();
        $this->profile = new Profile('', '', '');
    }

    /**
     * @param string          $old_plain_password
     * @param string          $new_plain_password
     * @param PasswordEncoder $password_encoder
     */
    public function changePassword(
        string $old_plain_password,
        string $new_plain_password,
        PasswordEncoder $password_encoder
    ): void {
        if ($new_plain_password === '') {
            throw InvalidArgumentException::emptyPassword();
        }

        if (!$password_encoder->equal($this->password, $old_plain_password)) {
            throw InvalidArgumentException::passwordNotMatch();
        }

        // password really changed
        if ($old_plain_password !== $new_plain_password) {
            $this->password = $password_encoder->encode($new_plain_password);
        }
    }

    /**
     * @return Social
     */
    public function social(): Social
    {
        return $this->social;
    }

    /**
     * @param int $facebook_id
     */
    public function connectFacebookAccount(int $facebook_id): void
    {
        $this->social = new Social($facebook_id, $this->social->googleId(), $this->social->twitterId());
    }

    /**
     * @param int $google_id
     */
    public function connectGoogleAccount(int $google_id): void
    {
        $this->social = new Social($this->social->facebookId(), $google_id, $this->social->twitterId());
    }

    /**
     * @param int $twitter_id
     */
    public function connectTwitterAccount(int $twitter_id): void
    {
        $this->social = new Social($this->social->facebookId(), $this->social->googleId(), $twitter_id);
    }

    /**
     * @return Profile
     */
    public function profile(): Profile
    {
        return $this->profile;
    }

    /**
     * @param Profile $profile
     */
    public function changeProfile(Profile $profile): void
    {
        $this->profile = $profile;
    }
}