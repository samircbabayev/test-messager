<?php

namespace App\EventDispatcher;

use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Log\LoggerInterface;

class LoggingEventDispatcherDecorator implements EventDispatcherInterface
{
    private $eventDispatcher;
    private $logger;

    public function __construct(EventDispatcherInterface $eventDispatcher, LoggerInterface $logger)
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->logger = $logger;
    }

    public function dispatch(object $event): object
    {
        $this->logger->info('Dispatching event: ' . get_class($event));

        return $this->eventDispatcher->dispatch($event);
    }
}
