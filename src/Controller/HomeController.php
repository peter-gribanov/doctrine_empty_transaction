<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\UserId;
use App\Entity\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends Controller
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
     * @Method("GET")
     */
    public function index()
    {
        $user = $this->rep->get(new UserId('D1aeVyioKNs'));

        // not really rename user
        $user->rename($user->profile()->firstname(), $user->profile()->lastname());

        return $this->render('index.html.twig', [
            'user' => $user,
        ]);
    }
}
