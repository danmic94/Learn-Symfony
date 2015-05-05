<?php
// src/AppBundle/Controller/Articlecontroller.php
namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArticleController extends Controller
{
    public function recentArticlesAction($max = 3)
    {
            //make a databese call or other logic
            //to get the "$max" most recent articles
            $articles = $insert_method_here $with $max;

            return $this->render(
                'article/recent_list.html.twig',
                array('articles' => $articles)
        );
    }
}