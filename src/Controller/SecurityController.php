<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\InscriptionType;
use App\Form\ReinitialiserMdpType;
use App\Notification\MailerServiceNotification;
use App\Repository\UsersRepository;
use DateTime;
use Doctrine\Common\Persistence\ObjectManager;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


/**
 * Class SecurityController
 * @package App\Controller
 */
class SecurityController extends AbstractController
{

    /**
     * @var PropertyRepository : l'utlisation des requetes de la classe
     */
    private $repository;
    /**
     * @var ObjectManager // permet d'interagir avec la bases de donnees
     */
    private $em;

    /**
     * SecurityController constructor.
     * @param UsersRepository $repository
     * @param ObjectManager $em
     */
    public function  __construct(UsersRepository $repository, ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }
    /**
     * @Route("/connexion", name="user.connexion")
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils) {
        //$error = $authenticationUtils->getLastAuthenticationError();// recupere les erreurs
        //$lastUsername = $authenticationUtils->getLastUsername();// recuper le dernier nom user taper par le user
        return $this->render('security/connexion.html.twig'
            /*, [
            'last_username' => $lastUsername,
            'error' => $error
        ]*/);
    }

    /**
     * @Route("/deconnexion", name="user.logout")
     */
    public function logout(){}

    /**
     * @Route("/mail-de-recuperation", name="user.motdepasseoublier")
     * @return Response
     */
    public function mot_de_passe_oublie(): Response
    {
        return $this->render('security/mailDeRecuperation.html.twig');
    }

    /**
     * assure l'inscription des utilisateurs
     * @Route("/inscription", name="user.inscription")
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @param MailerServiceNotification $contactNotification
     * @return RedirectResponse|Response
     *
     * @throws Exception
     */
    public function registration(Request $request, UserPasswordEncoderInterface $encoder, MailerServiceNotification $contactNotification)
    {
        $user = new Users();
        $form = $this->createForm(InscriptionType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->addRole('ROLE_USER');
            $user->setPassword($hash);
            $user->setConfirmToken($this->generateToken());
            $user->setIsActive(false);
            $this->em->persist($user);
            $this->em->flush();
            $token = $user->getConfirmToken();
            $email = $user->getEmail();
            $username = $user->getUsername();
            $nom = $user->getNom();
            $prenom = $user->getPrenom();
            $contactNotification->notify($email,$token, $username, $nom, $prenom, $id=0,'contact.html.twig');
            //$this->addFlash("success", 'Votre inscription a été validée, vous aller recevoir un email de confirmation pour activer votre compte et pouvoir vous connecté');
            return $this->redirectToRoute('user.connexion');
        }
        return $this->render('security/inscription.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/activecompte/{username}-{token}", name="user.activecompte")
     * @param $token
     * @param $username
     * @return Response
     */
    public function confirmAccount($token, $username): Response
    {
        $user = $this->repository->findOneBy(['Username' => $username]);
        $tokenExist = $user->getConfirmToken();
        if($token === $tokenExist) {
            $user->setConfirmToken('');
            $user->setIsActive(true);
            $this->em->persist($user);
            $this->em->flush();
            return $this->redirectToRoute('user.connexion');
        } else {
            return $this->render('security/inscription.html.twig');
        }
    }


    /**
     * @Route("/mot-de-passe-oublier", name="user.mdpRecuperation")
     * @param Request $request
     * @param MailerServiceNotification $mailerService
     * @return Response
     * @throws Exception
     */
    public function forgottenPassword(Request $request, MailerServiceNotification $mailerService): Response
    {
        $email = $request->request->get('email');
        $user = $this->repository->findOneBy(['Email' => $email]);
        if($user === null || $user->getIsActive() === false) {
            $this->addFlash('not-user-exist', 'utilisateur non trouvé');
            return $this->redirectToRoute('user.mailderecuperation');
        }
        $user->setTokenResetPassword($this->generateToken());
        $user->setCreateTokenPasswordAt(new DateTime());
        $this->em->persist($user);
        $this->em->flush();
        $token = $user->getTokenResetPassword();
        $email = $user->getEmail();
        $username = $user->getUsername();
        $nom = $user->getNom();
        $prenom = $user->getPrenom();
        $id = $user->getId();
        $mailerService->notify($email, $token, $username, $nom, $prenom, $id,'forgottenPassword.html.twig');
        //$this->addFlash('success1', 'Votre demande de recuperation a ete accepte, vous aller recevoir un email de confirmation pour activer votre compte et pouvoir vous connecté');
        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/resetpassword-{token}", name="user.modifiepassword")
     * @param Request $request
     * @param $token
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return Response
     * @throws Exception
     */
    public function resetPassword(Request $request, $token, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new Users();
        $form = $this->createForm(ReinitialiserMdpType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->repository->findOneBy(['TokenResetPassword' => $token]);
            if($user === null || $user->getIsActive() === false) {
                //$this->addFlash('not-user-exist', 'utilisateur non trouvé');
                return $this->redirectToRoute('home');
            }
            $user->setTokenResetPassword('');
            $user->setCreateTokenPasswordAt(new DateTime());
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('Password')->getData()
                )
            );
            $this->em->flush();
            return $this->redirectToRoute('user.connexion');
        }
        return $this->render('security/reinitialiserMdp.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/newsletter", name="user.newsletter")
     * @param Request $request
     * @param MailerServiceNotification $mailerService
     * @return RedirectResponse
     * @throws Exception
     */
    public function newsletter(Request $request, MailerServiceNotification $mailerService): RedirectResponse
    {
        $em = $this->getDoctrine()->getManager();
        $email = $request->request->get('email');
        $user = $this->getDoctrine()->getRepository(Users::class)->findOneBy(['Email' => $email]);
        if($user === null) {
            $this->addFlash('not-user-exist', 'utilisateur non trouvé');
            return $this->redirectToRoute('sendMailConfirmationReset');
        }
        $user->setConfirmToken($this->generateToken());
        $em->persist($user);
        $em->flush();
        $token = $user->getConfirmToken();
        $email = $user->getEmail();
        $username = $user->getUsername();
        $nom = $user->getNom();
        $prenom = $user->getPrenom();
        $id = $user->getId();
        $mailerService->notify($email, $token, $username, $nom, $prenom, $id,'contact.html.twig');
        return $this->redirectToRoute('user.login');
    }

    /**
     * @return string
     * @throws Exception
     */
    private function generateToken(): string
    {
        return rtrim(strtr(base64_encode(random_bytes(32)), '+/', '-_'), '=');
    }

}
