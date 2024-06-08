<?php


namespace App\Service;

use Symfony\Bridge\Twig\Mime\NotificationEmail;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailerService{


    public function __construct(
        #[Autowire('%admin_email%')] private string $adminEmail,
        private readonly MailerInterface $mailer,
        )
    {
        
    }

    public function sendWelcomeEmail(): void
    {
        $email = (new Email())
            ->from($this->adminEmail)
            ->to($this->adminEmail)
            ->subject('Test envoi Email')
            ->text('Ceci est un test d\'envoi de mail par le boss de Soweto')
            // ->html('<html><body><p>Hey!<br>Learn the best practices of building HTML emails and play with ready-to-go templates.</p>
            //         <p><a href="https://blog.mailtrap.io/build-html-email/">Mailtrap blog</a></p>
            //         </body></html>');
;
        $this->mailer->send($email);
    }


}