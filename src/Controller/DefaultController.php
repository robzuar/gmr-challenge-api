<?php

// src/Controller/DefaultController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController
{
    /**
     * @Route("/", name="homepage")
     * @return Response
     */
    public function index()
    {
        return new Response('WELCOME TO THE CHALLENGE');
    }
}