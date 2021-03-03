<?php

namespace App\Controller;

use App\Entity\Messagerie;
use App\Form\MessagerieType;
use App\Repository\MessagerieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/messagerie')]
class MessagerieController extends AbstractController
{
    #[Route('/', name: 'messagerie_index', methods: ['GET'])]
    public function index(MessagerieRepository $messagerieRepository): Response
    {
        return $this->render('messagerie/index.html.twig', [
            'messageries' => $messagerieRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'messagerie_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $messagerie = new Messagerie();
        $form = $this->createForm(MessagerieType::class, $messagerie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($messagerie);
            $entityManager->flush();

            return $this->redirectToRoute('messagerie_index');
        }

        return $this->render('messagerie/new.html.twig', [
            'messagerie' => $messagerie,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'messagerie_show', methods: ['GET'])]
    public function show(Messagerie $messagerie): Response
    {
        return $this->render('messagerie/show.html.twig', [
            'messagerie' => $messagerie,
        ]);
    }

    #[Route('/{id}/edit', name: 'messagerie_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Messagerie $messagerie): Response
    {
        $form = $this->createForm(MessagerieType::class, $messagerie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('messagerie_index');
        }

        return $this->render('messagerie/edit.html.twig', [
            'messagerie' => $messagerie,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'messagerie_delete', methods: ['DELETE'])]
    public function delete(Request $request, Messagerie $messagerie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$messagerie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($messagerie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('messagerie_index');
    }
}
