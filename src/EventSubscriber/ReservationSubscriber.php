<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Psr\Log\LoggerInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Locataire;
use App\Entity\Reservation;

class ReservationSubscriber implements EventSubscriberInterface
{
    private $entityManager;
    private $logger;

    public function __construct(EntityManagerInterface $entityManager, LoggerInterface $logger)
    {
        $this->entityManager = $entityManager;
        $this->logger = $logger;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            FormEvents::SUBMIT => 'onSubmit',
            KernelEvents::EXCEPTION => 'onKernelException',
        ];
    }

    public function onSubmit(FormEvent $event)
    {
        $form = $event->getForm();
        $entity = $event->getData();

        if ($entity instanceof Reservation) {
            // Extract data from the form fields
            $lastname = $form->get('lastname')->getData();
            $firstname = $form->get('firstname')->getData();
            $email = $form->get('email')->getData();
            $telephone = $form->get('telephone')->getData();

            // Create a new Locataire entity
            $locataire = new Locataire();
            $locataire->setLastname($lastname);
            $locataire->setFirstname($firstname);
            $locataire->setEmail($email);
            $locataire->setPhone($telephone);

            // Persist the Locataire entity
            $this->entityManager->persist($locataire);
            $this->entityManager->flush();

            // Associate the Locataire entity with the Reservation entity
            $entity->setLocataire($locataire);
        }
    }

    public function onKernelException(ExceptionEvent $event)
    {
        // Get the exception object from the received event
        $exception = $event->getThrowable();
        
        // Log the exception
        $this->logger->error('An exception occurred', [
            'exception' => $exception
        ]);

        // Optionally, modify the response object to display a custom error page
        // Example: create and set a custom error response
        // $response = new Response();
        // $response->setContent('An error occurred: ' . $exception->getMessage());
        // $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        // $event->setResponse($response);
    }
}
