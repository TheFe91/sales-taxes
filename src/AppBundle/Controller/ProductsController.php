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
            $product->setTaxes($category->getHasTaxes());
            $product->setShelfPrice($parameters['shelf_price']);
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
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function getProducts(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $return = array();
        $products = $em->getRepository('AppBundle:Products')->findAll();

        foreach ($products as $product) {

            $net_row_amount = $product->getQuantity() * $product->getShelfPrice();

            if ($product->getTaxes()) {
                $taxes = '10%';
                $row_amount = $net_row_amount + ($net_row_amount/10);
            }
            else {
                $taxes = 'FREE';
                $row_amount = $net_row_amount;
            }

//            $ra = number_format($row_amount, 2);
//            $last_digit = substr("$ra", -1);
//            if (in_array($last_digit, array('1', '2', '3', '4'))) {
//                $row_amount = substr("$ra", 0, -1) . '5';
//            }
//            elseif (in_array($last_digit, array('6', '7', '8', '9'))) {
//                $row_amount = substr("$ra", 0, -1) . '0';
//            }

            $return[$product->getUid()->toString()] = array(
                'basket' => $product->getBasketUid()->getName(),
                'category' => $product->getCategoryUid()->getDescription(),
                'description' => $product->getDescription(),
                'quantity' => $product->getQuantity(),
                'shelf_price' => $product->getShelfPrice(),
                'taxes' => $taxes,
                'row_amount' => number_format($row_amount, 2)
            );
        }

        return Responder::generateResponse(array('data' => $return));
    }
}
