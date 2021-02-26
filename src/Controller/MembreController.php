<?php

namespace App\Controller;


use App\Entity\User;
use App\Form\EditProfilType;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/membre')]
class MembreController extends AbstractController
{
    #[Route('/', name: 'membre')]
    public function index(): Response
    {
        return $this->render('membre/index.html.twig', [
            'controller_name' => 'MembreController',
        ]);
    }

    #[Route('/profil/{id}/edit', name: 'profil_edit', methods: ['GET', 'POST'])]

    public function edit(Request $request, User $user): Response
    {
        $userConnecte = $this->getUser();
        $userprofil = $user->getId();
        if ($userConnecte->getid() == $userprofil) {


            $form = $this->createForm(EditProfilType::class, $user);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('user_index');
            }

            return $this->render('user/edit.html.twig', [
                'user' => $user,
                'form' => $form->createView(),
            ]);
        }else{

            return $this->redirectToRoute('membre');
        }
    }
}
