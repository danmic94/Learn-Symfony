<?php
// src/AppBundle/Controller/MainController.php
namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class   MainController extends Controller
{
    public function contactAction()
    {
        return new Response('<h1 style="text-align: center;font-family: Verdana; color: #dd6666">Contact Page</h1>');
    }

    public function randomizeAction($limit){
        $number = rand(1,$limit);
        return $this->render('random/index.html.twig', array(
            'number'=> $number
        ));
    }
}