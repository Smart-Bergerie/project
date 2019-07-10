<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EvensController extends AbstractController
{
    /**
     * @route("/evens", name="evens")
     */
    public function evens(){
        return $this->render('evens/evenement.html.twig');
    }
}
