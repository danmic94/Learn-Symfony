<?php
// src/AppBundle/Controller/MainController.php
namespace AdittionBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class   AdittionController extends Controller
{
    public function addAction($a, $b){

        $sum = $a + $b;
        return new Response(
            '<html><body style="background-color: #aaaaaa"><p style="text-align: center;color: #66dd66;font-weight: bold;font-family: Helvetica; font-size: 150px;margin-top: 15%">The sum is: '.$sum.'</p></body></html>'
        );
    }

    public function helloAction()
    {
        return new Response('Whaddap Dude!');
    }


    public function nameAction($name)
    {
        return $this->render('hello/index.html.twig', array(
            'name'=> $name
        ));
    }
}
