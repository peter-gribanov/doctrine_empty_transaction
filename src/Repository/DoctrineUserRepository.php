<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\User;
use App\Entity\UserId;
use App\Entity\UserRepository;
use App\Exception\UserNotFoundException;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineUserRepository implements UserRepository
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var ObjectRepository
     */
    private $rep;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->rep = $em->getRepository(User::class);
    }

    /**
     * @param UserId $id
     *
     * @return User
     */
    public function get(UserId $id): User
    {
        $user = $this->rep->find($id);

        if (!($user instanceof User)) {
            throw UserNotFoundException::withId($id);
        }

        return $user;
    }

    /**
     * @param User $user
     */
    public function remove(User $user): void
    {
        $this->em->remove($user);
        $this->em->flush();
    }
}
