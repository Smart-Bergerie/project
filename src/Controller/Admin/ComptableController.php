<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 * Class ComptableController
 * @package App\Controller\Admin
 */
class ComptableController extends AbstractController
{
    /**
     * @Route("/comptable", name="admin.comptable")
     */
    public function index()
    {
        return $this->render('admin/comptable/index.html.twig');
    }
}
