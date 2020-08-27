<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AllproductController extends AbstractController
{
    /**
     * @Route("/allproduct", name="allproduct")
     */
    public function index()
    {
        return $this->render('allproduct/index.html.twig', [
            'controller_name' => 'AllproductController',
        ]);
    }
}
