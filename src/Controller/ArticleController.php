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
use App\Repository\ArticleRepository;

class ArticleController extends AbstractController
{

    #[Route('/{id}/show' , name : 'each_article')]
    public function eachArticle(Article $article) : Response

    {
        return $this->render("article/show.html.twig" ,[
            "display" => $article
        ]);
    }

    #[Route('/article', name :'view_article')]
    public function displayArticle(ArticleRepository $repository) : Response

    {
        $article = $repository->findAll();

        return $this->render('article/view.html.twig', [
            'article'=>$article
        ]);
    }

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
            }

            return $this->render('article/article.html.twig',[
                'form' => $form->createView()
            ]);
    }

    #[Route('/newarticle/{id}', name: 'edit_article', methods:['GET','POST'])]
    public function editArticle(ArticleRepository $repository, int $id) : Response
    {
        $article = $repository->findOneBy(["id" => $id]);
        $form = $this->createForm(ArticleType::class, $article);
        return $this->render('article/edit.html.twig',[
            'form' => $form->createView()
        ]);
    }

    #[Route('/article/delete/{id}', name : 'delete_article', methods: ['GET'])]
    public function delete(EntityManagerInterface $manager, Article $article) : Response
    {
        $manager->remove($article);
        $manager->flush();

            $this->addFlash(
                'success',
                'Votre ingredient a été modifié avec succès !'
            );

        return $this->redirectToRoute('article.html.twig');
    }
    }
