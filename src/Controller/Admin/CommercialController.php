<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 * Class CommercialController
 * @package App\Controller\Admin
 */
class CommercialController extends AbstractController
{
    /**
     * @Route("/commercial", name="admin.commercial")
     */
    public function index()
    {
        return $this->render('admin/commercial/index.html.twig');
    }
}
