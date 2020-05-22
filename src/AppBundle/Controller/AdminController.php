<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends Controller
{
    /**
     * @Route("/", name="indexAction_url")
     * @return Response
     */
    public function indexAction(): Response
    {
        return $this->redirectToRoute('renderReceipts_url');
    }

    /**
     * @Route("/topbar", name="topbarAction_url")
     * @return Response
     */
    public function topbarAction(): Response
    {
        return $this->render('@App/includes/topbar.html.twig', array());
    }
}
