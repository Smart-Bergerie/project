<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 * Class SuperAdminController
 * @package App\Controller\Admin
 */
class SuperAdminController extends AbstractController
{
    /**
     * @Route("/administrateur", name="admin.administrateur")
     */
    public function index()
    {
        return $this->render('admin/superadmin/index.html.twig');
    }
}
