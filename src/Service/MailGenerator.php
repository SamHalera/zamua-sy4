<?php 

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class MailGenerator
{
    

    private $mailer;


    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }


    public function sendMail($userName, $userEmail, $message, $fileTemplate, bool $isAdminMode)
    {

        $recipient = $isAdminMode ? $userEmail : "contact@zamuamusic.com";
        $sender = $isAdminMode ? "contact@zamuamusic.com" :  $userEmail;
        
        if($isAdminMode){
            $subject = 'Message from Zamua website: ' . $userName . ' - ' . $userEmail;
        } else {
            $subject = 'Hi '. $userName. ' Thank you for contacting me!';
        }

        $email = new TemplatedEmail();
        $email
            ->from($recipient)
            ->to($sender)
            ->subject($subject)
            ->htmlTemplate($fileTemplate)
            ->textTemplate(str_replace('html', 'txt', $fileTemplate))
            ->context([
                'userName' => $userName,
                'userEmail' => $userEmail,
                'message' => $message,
            ])
        ;
        $this->mailer->send($email);
    }

} 
