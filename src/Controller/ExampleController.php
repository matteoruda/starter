<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/example", name="example_")
 */
class ExampleController extends AbstractController
{
    /**
     * @Route("/full", name="full")
     */
    public function full(): Response
    {
        return $this->render('example/index.html.twig', [
            'title' => 'Full Example',
        ]);
    }

    /**
     * @Route("/empty", name="empty")
     */
    public function empty(): Response
    {
        return $this->render('example/empty.html.twig', [
            'title' => 'Empty Example',
        ]);
    }
}
