<?php

namespace App\Controller;

use App\Repository\ContentRepository;
use App\Repository\ImageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'accueil')]
    public function accueil(ContentRepository $contentRepository)
    {
        //get user content
        $contents = $contentRepository->findBy(['user' => $this->getUser()]);

        $contentDiapo = null;
        $contentMarques = null;
        $imagesDiapo = null;
        $imagesMarques = null;

        foreach ($contents as $content) {
            if ($content->getContentSector()->getId() == 1){
                $contentDiapo = $content;
                $imagesDiapo = $content->getImages();
            }

            if ($content->getContentSector()->getId() == 2) {
                $contentMarques = $content;
                $imagesMarques = $content->getImages();
            }
        }

        return $this->render('/base.html.twig', [
            'page_title' => 'ma page',
            'user' => $this->getUser() != null ? $this->getUser()->getUserIdentifier() : '',
            'contentDiapo' => $contentDiapo,
            'contentMarques' => $contentMarques,
            'imagesDiapo' => $imagesDiapo,
            'imagesMarques' => $imagesMarques
        ]);
    }
}