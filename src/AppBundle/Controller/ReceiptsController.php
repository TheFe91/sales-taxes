<?php

namespace AppBundle\Controller;

use AppBundle\Services\Responder;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/generate-receipt", name="generateReceipts_url")
     * @param Request $request
     * @return Response
     */
    public function generateReceipts(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $parameters = $request->request->all();

        $basket = $em->getRepository('AppBundle:ShoppingBaskets')->find($parameters['basket']);
        $products = $em->getRepository('AppBundle:Products')->findBy(array('basket_uid' => $basket));


        return Responder::generateResponse();
    }

    /**
     * @Route("/pdf-receipt", name="pdfReceipts_url")
     * @return Response
     */
    public function pdfReceipts(): Response
    {
        $options = new Options();
        $options->set('defaultFont', 'Roboto');


        $dompdf = new Dompdf($options);

        $html = $this->renderView('@App/receipt_pdf.html.twig', [
            'title' => "Test pdf generator"
        ]);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $output = $dompdf->output();

        $publicDirectory = $this->get('kernel')->getProjectDir() . '/pdf';
        $pdfFilepath =  $publicDirectory . '/mypdf.pdf';

        file_put_contents($pdfFilepath, $output);

//        return new BinaryFileResponse($pdfFilepath, );
    }
}
