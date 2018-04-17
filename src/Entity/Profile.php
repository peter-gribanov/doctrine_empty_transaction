<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
final class Profile
{
    /**
     * @ORM\Column(name="avatar", type="string", length=255, nullable=false)
     *
     * @var string
     */
    private $avatar = '';

    /**
     * @ORM\Column(name="firstname", type="string", length=255, nullable=false)
     *
     * @var string
     */
    private $firstname = '';

    /**
     * @ORM\Column(name="lastname", type="string", length=255, nullable=false)
     *
     * @var string
     */
    private $lastname = '';

    /**
     * @ORM\Column(name="gender", type="Gender", nullable=false)
     *
     * @var Gender
     */
    private $gender;

    /**
     * @ORM\Column(name="birth_at", type="DateTimeImmutable", nullable=true)
     *
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
        ?Gender $gender = null,
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
