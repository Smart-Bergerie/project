<?php


namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * @Route("/admin")
 * Class SecurityController
 * @package App\Controller\Admin
 */
class SecurityController extends AbstractController
{
    /**
     * @Route("/connexion", name="admin.connexion")
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils) {
        $error = $authenticationUtils->getLastAuthenticationError();// recupere les erreurs
        $lastUsername = $authenticationUtils->getLastUsername();// recuper le dernier nom user taper par le user
        return $this->render('admin/security/connexion.html.twig'
        , [
        'last_username' => $lastUsername,
        'error' => $error,
         'link' => 'link'
    ]);
    }

    /**
     * @Route("/deconnexion", name="admin.deconnexion")
     */
    public function logout(): void
    {}

}