<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 * Class VeterinaireController
 * @package App\Controller\Admin
 */
class VeterinaireController extends AbstractController
{
    /**
     * @Route("/veterinaire", name="admin.veterinaire")
     */
    public function index()
    {
        return $this->render('admin/veterinaire/index.html.twig');
    }
}
