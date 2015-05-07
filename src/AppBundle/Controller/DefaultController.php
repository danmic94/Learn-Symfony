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
        public function showAction($id)
        {
            $id = intval($id);
            $repository = $this->getDoctrine()->getRepository('AppBundle:Product');
            $product = $repository->find($id);

            if (isset($product) === FALSE) {
                return $this->render('dbactions/error.html.twig', array(
                    'product' => $product
                ));
            }

                return $this->render('dbactions/index.html.twig', array(
                    'product' => $product
            ));
        }

        public function updateAction($id)
        {
            $em = $this->getDoctrine()->getManager();
            $product = $em->getRepository('AppBundleProduct')->find($id);

            if(!$product) {
                throw $this->createNotFoundException(
                    'No product found for id '.$id
                );
            }
            $product->setName('New product name!');
            $em->flush();

            return $this->redirectToRoute('homepage');
        }

        public function deleteAction($id)
        {
            $em = $this->getDoctrine()->getManager();
            $product = $em->getRepository('AppBundleProduct')->find($id);

            if(!$product) {
                throw $this->createNotFoundException(
                    'No product found for id '.$id
                );
            }
            $product->remove($product);
            $em->flush();

            return $this->render('homepage');
    }
    }


