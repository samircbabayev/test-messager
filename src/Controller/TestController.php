<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Event\TestEvent;
use Psr\EventDispatcher\EventDispatcherInterface;

class TestController
{
    private $eventDispatcher;

    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    #[Route('/api/test/event', name: 'api_test_event')]
    public function testEvent(Request $request): Response
    {
        $message = $request->query->get('message', 'Сообщение не передано');

        $event = new TestEvent($message);
        $this->eventDispatcher->dispatch($event);

        return new Response('Event dispatched with message: ' . $message);
    }
}
