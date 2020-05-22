<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Products;
use AppBundle\Entity\ShoppingBaskets;
use AppBundle\Services\Responder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Exception;
use Symfony\Component\Routing\Annotation\Route;

class ProductsController extends Controller
{
    /**
     * @Route("/get-baskets", name="getBaskets_url")
     * @return Response
     */
    public function getBaskets() {
        $em = $this->getDoctrine()->getManager();
        $return = array();

        $baskets = $em->getRepository('AppBundle:ShoppingBaskets')->findAll();

        foreach ($baskets as $basket) {
            $return[$basket->getUid()->toString()] = $basket->getName();
        }

        return Responder::generateResponse(array('data' => $return));
    }

    /**
     * @Route("/add-product", name="addProduct_url")
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function addProduct(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $parameters = $request->request->all();
        $UUIDv4 = '/^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i';

        try {
            if(preg_match($UUIDv4, $parameters['basket'])) {
                $basket = $em->getRepository('AppBundle:ShoppingBaskets')->find($parameters['basket']);
            }
            else {
                $basket = new ShoppingBaskets();
                $basket->setName($parameters['basket']);
                $em->persist($basket);
                $em->flush();
            }

            $category = $em->getRepository('AppBundle:Categories')->find($parameters['category']);

            $product = new Products();
            $product->setBasketUid($basket);
            $product->setDescription($parameters['description']);
            $product->setCategoryUid($category);
            $product->setQuantity($parameters['quantity']);
            $product->setTaxes10($category->getHasTaxes());
            $product->setTaxes5(strpos(strtolower($parameters['description']), 'imported'));
            $product->setShelfPrice($parameters['shelf_price']);
            $product->setRowAmount($parameters['quantity'] * $parameters['shelf_price']);
            $em->persist($product);
            $em->flush();

            return Responder::generateResponse();
        }
        catch (\Exception $ex) {
            return Responder::generateError($ex->getMessage());
        }
    }

    /**
     * @Route("/get-products", name="getProducts_url")
     * @return Response
     */
    public function getProducts(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $return = array();
        $products = $em->getRepository('AppBundle:Products')->findAll();

        foreach ($products as $product) {

            $taxes = 'FREE';

            if ($product->getTaxes10() && $product->getTaxes5()) {
                $taxes = '10% + 5%';
            }
            else if ($product->getTaxes10() && !$product->getTaxes5()) {
                $taxes = '10%';
            }
            else if (!$product->getTaxes10() && $product->getTaxes5()) {
                $taxes = '5%';
            }

            $return[$product->getUid()->toString()] = array(
                'basket' => $product->getBasketUid()->getName(),
                'category' => $product->getCategoryUid()->getDescription(),
                'description' => $product->getDescription(),
                'quantity' => $product->getQuantity(),
                'shelf_price' => $product->getShelfPrice(),
                'taxes' => $taxes
            );
        }

        return Responder::generateResponse(array('data' => $return));
    }
}
