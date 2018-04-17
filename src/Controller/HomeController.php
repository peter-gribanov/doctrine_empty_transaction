<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\UserId;
use App\Entity\UserRepository;
use Symfony\Component\Routing\Annotation\Route;

class HomeController
{
    /**
     * @var UserRepository
     */
    private $rep;

    /**
     * @param UserRepository $rep
     */
    public function __construct(UserRepository $rep)
    {
        $this->rep = $rep;
    }

    /**
     * @Route("/")
     */
    public function index()
    {
        $user = $this->rep->get(new UserId(1));

        // not really rename
        $user->changeProfile($user->profile()->rename(
            $user->profile()->firstname(),
            $user->profile()->lastname()
        ));
    }
}
