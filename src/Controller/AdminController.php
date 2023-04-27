<?php

namespace App\Controller;

use App\Repository\ContentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'admin')]
    public function index(ContentRepository $contentRepository)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'L\'utilisateur essaye d\'accéder à une page non autorisée !');

        //chercher tous les contenus du client
        $contents = $contentRepository->findBy(['user' => $this->getUser()]);

        return $this->render('/admin/index.html.twig', [
            'contents' => $contents
        ]);
    }
}