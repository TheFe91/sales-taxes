<?php

namespace AppBundle\Controller;

use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReceiptsController extends Controller
{
    /**
     * @Route("/receipts", name="renderReceipts_url")
     * @return Response
     */
    public function receipts(): Response
    {
        $em = $this->getDoctrine()->getManager();

        return $this->render('@App/receipts.html.twig',
            array(
                'categories' => $em->getRepository('AppBundle:Categories')->findAll(),
            )
        );
    }

    /**
     * @Route("/generate-receipt/{basket_uid}", name="generateReceipts_url", defaults={"basket_uid" = ""})
     * @return Response
     */
    public function generateReceipts($basket_uid): Response
    {
        $em = $this->getDoctrine()->getManager();

        $basket = $em->getRepository('AppBundle:ShoppingBaskets')->find($basket_uid);
        $products = $em->getRepository('AppBundle:Products')->findBy(array('basket_uid' => $basket));

        return $this->render('@App/receipt_pdf.html.twig', [
            'title' => $basket->getName(),
            'products' => $products,
        ]);
    }
}
