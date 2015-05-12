<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Product;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Author;


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
        $product->setName('T-Shirt');
        $product->setPrice('30');
        $product->setDescription('Beautiful Deadpool Shirt');

        $em = $this->getDoctrine()->getManager();

        $em->persist($product);
        $em->flush();


        //returns response that the query created new entry in db
        return new Response('Created product id' . $product->getId());
    }

    public function showAction($id)
    {
        $product = $this->getDoctrine()
            ->getRepository('AppBundle:Product')
            ->findOneByIdJoinedToCategory($id);

        $category = $product->getCategory();

        if (isset($product) === FALSE) {
            return $this->render('dbactions/error.html.twig');
        }

        return $this->render('dbactions/index.html.twig', array(
            'product' => $product,
        ));
    }

    public function upAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('AppBundleProduct')->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id ' . $id
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

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id ' . $id
            );
        }
        $product->remove($product);
        $em->flush();

        return $this->render('homepage');
    }

    //Generateing a row in th Database
    public function createProductAction()
    {
        $category = new Category();
        $category->setName('Main Products');

        $product = new Product();
        $product->setName('Foo');
        $product->setPrice(21);
        $product->setDescription('Lorem ipsum dolor');
        //relate this product to the category
        $product->setCategory($category);
        $product->setCreatedAt(new \DateTime('now', 'UTC'));

        $em = $this->getDoctrine()->getManager();
        $em->persist($category);
        $em->persist($product);
        $em->flush();

        return new Response(
            'Created product id: ' . $product->getId()
            . ' and category id: ' . $category->getId()
        );
    }

    public function createdAtAction()
    {
        $product = new Product();
        $product->setCreatedAtValue();
        $response = $product->getCreatedAtValue();

        return new Response('Produsul este: ' . $response);
    }

    public function authorAction()
    {

        $author = new Author();
        $name= "Vasil";
        $validator = $this->get('validator');
        $errors = $validator->validate($author);

        if (count($errors) > 0) {
            return $this->render('author/validation.html.twig', array(
                'errors' => $errors,
            ));
        }

        return new Response('The author is valid! Yes!: <h1>'.$name.'</h1>');

    }

    public function updateAction(Request $request)
    {
        $author = new Author();
        $form = $this->createForm(new Author(), $author);

        $form->handleRequest($request);

        if ($form->isValid()) {
            // the validation passed, do something with the $author object
            return $this->redirectToRoute('name');
        }

        return $this->render('author/form.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}


