<?php

namespace App\Controller;

use App\Entity\Content;
use App\Entity\Image;
use App\Form\ContentType;
use App\Repository\ContentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/content')]
class ContentController extends AbstractController
{
    #[Route('/', name: 'app_content_index', methods: ['GET'])]
    public function index(ContentRepository $contentRepository): Response
    {
        return $this->render('content/index.html.twig', [
            'contents' => $contentRepository->findBy(['user' => $this->getUser()]),
        ]);
    }

    #[Route('/new', name: 'app_content_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ContentRepository $contentRepository): Response
    {
        $content = new Content();
        $form = $this->createForm(ContentType::class, $content);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // récupération des images
            $images = $form->get('images')->getData();

            foreach($images as $image){
                // On génère un nouveau nom de fichier
                $fichier = md5(uniqid()).'.'.$image->guessExtension();

                // On copie le fichier dans le dossier uploads
                $image->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );

                // On crée l'image dans la base de données
                $img = new Image();
                $img->setFilename($fichier);
                $content->addImage($img);
                $content->setUser($this->getUser());
            }

            $contentRepository->save($content, true);

            return $this->redirectToRoute('admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('content/new.html.twig', [
            'content' => $content,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_content_show', methods: ['GET'])]
    public function show(Content $content): Response
    {
        return $this->render('content/show.html.twig', [
            'content' => $content,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_content_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Content $content, ContentRepository $contentRepository): Response
    {
        $form = $this->createForm(ContentType::class, $content);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // récupération des images
            $images = $form->get('images')->getData();

            foreach($images as $image){
                // On génère un nouveau nom de fichier
                $fichier = md5(uniqid()).'.'.$image->guessExtension();

                // On copie le fichier dans le dossier uploads
                $image->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );

                // On crée l'image dans la base de données
                $img = new Image();
                $img->setFilename($fichier);
                $content->addImage($img);
                $content->setUser($this->getUser());
            }
            $contentRepository->save($content, true);

            return $this->redirectToRoute('app_content_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('content/edit.html.twig', [
            'content' => $content,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_content_delete', methods: ['POST'])]
    public function delete(Request $request, Content $content, ContentRepository $contentRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$content->getId(), $request->request->get('_token'))) {
            $contentRepository->remove($content, true);
        }

        return $this->redirectToRoute('app_content_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/delete/image/{id}', name: 'content_delete_image', methods: ['DELETE'])]
    public function deleteImage(Image $image, Request $request, EntityManagerInterface $entityManager){
        $data = json_decode($request->getContent(), true);

        // On vérifie si le token est valide
        if($this->isCsrfTokenValid('delete'.$image->getId(), $data['_token'])){
            // On récupère le nom de l'image
            $nom = $image->getFilename();
            // On supprime le fichier
            unlink($this->getParameter('images_directory').'/'.$nom);

            // On supprime l'entrée de la bas
            $entityManager->remove($image);
            $entityManager->flush();

            // On répond en json
            return new JsonResponse(['success' => 1]);
        }else{
            return new JsonResponse(['error' => 'Token Invalide'], 400);
        }
    }
}
