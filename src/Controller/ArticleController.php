<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Entity\Article;
use App\Form\ArticleType;

class ArticleController extends AbstractController
{
    #[Route('/newarticle', name: 'app_article', methods:['GET','POST'])]
    public function createArticle(Request $request, EntityManagerInterface $manager): Response
    {
            $article = new Article();
            $form = $this->createForm(ArticleType::class, $article);

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid())
            {
               $article = $form->getData();

               $manager->persist($article);
               $manager->flush();

               $this->redirectToRoute('home/index.html.twig');
            }

            return $this->render('article/article.html.twig',[
                'form' => $form->createView()
            ]);
    }
    }
