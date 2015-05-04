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
        return new Response(
            '<html><body style="background-color: #aaaaaa"><p style="text-align: center;color: #66dd66;font-weight: bold;font-family: Helvetica; font-size: 150px;margin-top: 15%">Number: '.rand(1,$limit).'</p></body></html>'
        );
    }
}