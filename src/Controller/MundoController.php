<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MundoController extends Controller
{
    /**
     * @Route("/mundo", name="mundo")
     */
    public function index()
    {
        return $this->render('mundo/index.html.twig', [
            'controller_name' => 'MundoController',
        ]);
    }
}
