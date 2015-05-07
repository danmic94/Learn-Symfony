<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Product;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends Controller
{
    /**
     * @Route("/app/example", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('default/index.html.twig');
    }
    //This creates a new entry in the data base
    public function createAction()
    {
        $product = new Product();
        $product ->setName('T-Shirt');
        $product ->setPrice('30');
        $product ->setDescription('Beautiful Deadpool Shirt');

        $em = $this->getDoctrine()->getManager();

        $em->persist($product);
        $em->flush();


        //returns response that the query created new entry in db
        return new Response('Created product id' .$product->getId());
    }
}
