<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 * Class HomeController
 * @package App\Controller
 */
class HomeController extends AbstractController
{

    /**
     * @Route("/", name="home")
     */
    public function home(){
        return $this->render('home/home.html.twig');
    }

    /**
     * @Route("/user", name="user.home")
     */
    public function index(){
        return $this->render('home/home.html.twig');
    }
}
