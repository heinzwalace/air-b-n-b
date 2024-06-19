<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;

class ExceptionSubscriber implements EventSubscriberInterface
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function onKernelException(ExceptionEvent $event)
    {
        // Get the exception object from the received event
        // $exception = $event->getThrowable();
        
        // // Log the exception message
        // $this->logger->error('An exception occurred', [
        //     'exception' => $exception
        // ]);

        // // Optionally, you can modify the response object to display a custom error page
        // $response = new Response();
        // $response->setContent('An error occurred: ' . $exception->getMessage());
        // $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);

        // // Send the modified response object to the event
        // $event->setResponse($response);
    }

    public static function getSubscribedEvents()
    {
        // Return the subscribed events, their methods and priorities
        return [
            KernelEvents::EXCEPTION => 'onKernelException',
        ];
    }
}