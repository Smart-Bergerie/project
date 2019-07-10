<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EdaralController extends AbstractController
{
    /**
     * @Route("/edaral", name="edaral")
     */
    public function index()
    {
        return $this->render('edaral/index.html.twig');
    }
}
