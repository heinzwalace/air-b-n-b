<?php

// src/EventSubscriber/RequestSubscriber.php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpFoundation\RequestStack;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use App\Entity\Locataire;

class RequestSubscriber implements EventSubscriberInterface
{
    private $entityManager;
    private $requestStack;
    private $logger;

    public function __construct(EntityManagerInterface $entityManager, RequestStack $requestStack, LoggerInterface $logger)
    {
        $this->entityManager = $entityManager;
        $this->requestStack = $requestStack;
        $this->logger = $logger;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => 'onKernelRequest',
        ];
    }

    public function onKernelRequest(RequestEvent $event)
    {
        $request = $event->getRequest();

        // Check if the request is a POST request and if it's for a specific route or path
        if ($request->isMethod('POST')) {
            // $reservationData = $request->request;
            $formData = $request->request->all();

            if (isset($formData['Reservation'])) {
                // Accède aux données spécifiques de "Reservation"
                $reservationData = $formData['Reservation'];
                dump($reservationData);

                $lastname = $reservationData['lastname'] ?? null;
                $firstname = $reservationData['firstname'] ?? null;
                $telephone = $reservationData['telephone'] ?? null;
                $email = $reservationData['email'] ?? null;

                // Create a new Locataire entity if all required data is present
                if ($lastname && $firstname && $email && $telephone) {
                    $locataire = new Locataire();
                    $locataire->setLastname($lastname);
                    $locataire->setFirstname($firstname);
                    $locataire->setEmail($email);
                    $locataire->setPhone($telephone);

                    // Persist the Locataire entity
                    $this->entityManager->persist($locataire);
                    $this->entityManager->flush();

                    // Optionally, log the creation of the Locataire entity
                    $this->logger->info('New Locataire created', [
                        'lastname' => $lastname,
                        'firstname' => $firstname,
                        'email' => $email,
                        'telephone' => $telephone,
                    ]);
                }
            }
        }
    }
}
