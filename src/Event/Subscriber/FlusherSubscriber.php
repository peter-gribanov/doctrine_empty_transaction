<?php
declare(strict_types=1);

/**
 * Lupin package.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2011, Peter Gribanov
 */

namespace App\Event\Subscriber;

use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\ConsoleEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\PostResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class FlusherSubscriber implements EventSubscriberInterface
{
    /**
     * @var ManagerRegistry
     */
    private $registry;

    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        $this->registry = $registry;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            ConsoleEvents::TERMINATE => 'onTerminate',
            KernelEvents::TERMINATE => 'postResponse',
        ];
    }

    public function onTerminate()
    {
        $this->flush();
    }

    /**
     * @param PostResponseEvent $event
     */
    public function postResponse(PostResponseEvent $event)
    {
        if ($event->isMasterRequest()) {
            $this->flush();
        }
    }

    private function flush()
    {
        foreach ($this->registry->getManagers() as $manager) {
            /* @var $manager EntityManagerInterface */
            if ($manager->isOpen()) {
                $manager->flush();
            }
        }
    }
}
