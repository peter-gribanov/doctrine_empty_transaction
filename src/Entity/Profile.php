<?php
declare(strict_types=1);

namespace App\Entity;

final class Profile
{
    /**
     * @var string
     */
    private $avatar = '';

    /**
     * @var string
     */
    private $firstname = '';

    /**
     * @var string
     */
    private $lastname = '';

    /**
     * @var Gender
     */
    private $gender;

    /**
     * @var \DateTimeImmutable|null
     */
    private $birth_at;

    /**
     * @param string                  $avatar
     * @param string                  $firstname
     * @param string                  $lastname
     * @param Gender|null             $gender
     * @param \DateTimeImmutable|null $birth_at
     */
    public function __construct(
        string $avatar,
        string $firstname,
        string $lastname,
        Gender $gender = null,
        ?\DateTimeImmutable $birth_at = null
    ) {
        $this->avatar = $avatar;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->gender = $gender ?: Gender::unknown();
        $this->birth_at = $birth_at;
    }

    /**
     * @return string
     */
    public function avatar(): string
    {
        return $this->avatar;
    }

    /**
     * @return string
     */
    public function firstname(): string
    {
        return $this->firstname;
    }

    /**
     * @return string
     */
    public function lastname(): string
    {
        return $this->lastname;
    }

    /**
     * @param string $new_firstname
     * @param string $new_lastname
     *
     * @return Profile
     */
    public function rename(string $new_firstname, string $new_lastname): self
    {
        $self = clone $this;
        $self->firstname = $new_firstname;
        $self->lastname = $new_lastname;

        return $self;
    }

    /**
     * @return Gender
     */
    public function gender(): Gender
    {
        return $this->gender;
    }

    /**
     * @return \DateTimeImmutable|null
     */
    public function birthAt(): ?\DateTimeImmutable
    {
        return $this->birth_at;
    }
}
