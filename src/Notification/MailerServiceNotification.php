<?php
namespace App\Notification;


use Swift_Mailer;
use Swift_Message;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class MailerServiceNotification extends AbstractController{

    /**
     * @var Swift_Mailer
     */
    private $mailer;


    /**
     * ContactNotification constructor.
     * @param Swift_Mailer $mailer
     */
    public function __construct(Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param $to
     * @param $token
     * @param $username
     * @param $nom
     * @param $premon
     * @param $template
     * @param $id
     */
    public function notify($to,$token,$username,$nom, $premon, $id, $template): void
    {
        $message = (new Swift_Message('Agence Smartbergerie'))
            ->setFrom('noreply@agence.fr')
            ->setTo($to)
            //->setReplyTo($contact->getEmail())
            ->setBody(
                $this->renderView(
                    'emails/'.$template,
                    [
                        'token' => $token,
                        'username' => $username,
                        'nom' => $nom,
                        'prenom' => $premon,
                        'id' => $id,
                        'email' => $to
                    ]
                ),
                'text/html'
            )
        ;
        $this->mailer->send($message);
    }

}
