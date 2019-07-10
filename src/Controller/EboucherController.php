<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EboucherController extends AbstractController
{
    /**
     * @Route("/eboucher", name="eboucher")
     */
    public function index()
    {
        return $this->render('eboucher/index.html.twig');
    }
}
