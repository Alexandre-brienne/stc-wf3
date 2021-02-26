<?php

namespace App\Controller;

use App\Entity\SousCategories;
use App\Form\SousCategoriesType;
use App\Repository\SousCategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/sous-categories')]
class SousCategoriesController extends AbstractController
{
    #[Route('/', name: 'sous_categories_index', methods: ['GET'])]
    public function index(SousCategoriesRepository $sousCategoriesRepository): Response
    {
        return $this->render('sous_categories/index.html.twig', [
            'sous_categories' => $sousCategoriesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'sous_categories_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $sousCategory = new SousCategories();
        $form = $this->createForm(SousCategoriesType::class, $sousCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sousCategory);
            $entityManager->flush();

            return $this->redirectToRoute('sous_categories_index');
        }

        return $this->render('sous_categories/new.html.twig', [
            'sous_category' => $sousCategory,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'sous_categories_show', methods: ['GET'])]
    public function show(SousCategories $sousCategory): Response
    {
        return $this->render('sous_categories/show.html.twig', [
            'sous_category' => $sousCategory,
        ]);
    }

    #[Route('/{id}/edit', name: 'sous_categories_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SousCategories $sousCategory): Response
    {
        $form = $this->createForm(SousCategoriesType::class, $sousCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sous_categories_index');
        }

        return $this->render('sous_categories/edit.html.twig', [
            'sous_category' => $sousCategory,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'sous_categories_delete', methods: ['DELETE'])]
    public function delete(Request $request, SousCategories $sousCategory): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sousCategory->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sousCategory);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sous_categories_index');
    }
}
