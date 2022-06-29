<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function home(): Response
    {
        return $this->render('home/index.html.twig', [
            'home' => 'home',
        ]);
    }

    #[Route('/histoire', name: 'app_story')]
    public function story(): Response
    {
        return $this->render('pages/story.html.twig', [
            'story' => 'story',
        ]);
    }

    #[Route('/gammes', name: 'app_gammes')]
    public function gammes(): Response
    {
        return $this->render('pages/gammes.html.twig', [
            'gammes' => 'gammes',
        ]);
    }

    #[Route('/proprietes', name: 'app_proprietes')]
    public function proprietes(): Response
    {
        return $this->render('pages/proprietes.html.twig', [
            'proprietes' => 'proprietes',
        ]);
    }

    #[Route('/join', name: 'app_join')]
    public function join(): Response
    {
        return $this->render('pages/join.html.twig', [
            'join' => 'join',
        ]);
    }

    #[Route('/contact', name: 'app_contact')]
    public function contact(): Response
    {
        return $this->render('pages/contact.html.twig', [
            'contact' => 'contact',
        ]);
    }
}




