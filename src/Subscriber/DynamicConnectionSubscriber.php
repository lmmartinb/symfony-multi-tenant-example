<?php

declare(strict_types=1);

namespace App\Subscriber;

use App\Doctrine\DynamicConnection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class DynamicConnectionSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly array $databases,
    ) {
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        $connection = $event->getRequest()->query->get('conn');

        /** @var DynamicConnection $databaseConnection */
        $databaseConnection = $this->entityManager->getConnection();

        $urlConnection = $this->databases[$connection] ?? null;

        if ($urlConnection) {
            $databaseConnection->swapDatabase($urlConnection);
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => 'onKernelRequest',
        ];
    }
}