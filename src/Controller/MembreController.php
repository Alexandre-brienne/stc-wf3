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
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

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

    #[Route('/profil/{username}', name: 'profil', methods: ['GET'])]
    public function profil(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }


    #[Route('/profil/{username}/edit', name: 'profil_edit', methods: ['GET', 'POST'])]

    public function edit(Request $request, User $user, SluggerInterface $slugger): Response
    {
        $userConnecte = $this->getUser();
        $userprofil = $user->getId();
        if ($userConnecte->getid() == $userprofil) {


            $form = $this->createForm(EditProfilType::class, $user);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $imageFile = $form->get('image_profil')->getData();

                if ($imageFile) {
                    $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                    $safeFilename = $slugger->slug($originalFilename);
                    $newFilename  = md5(uniqid()) . '.' . $imageFile->guessExtension();
                    try {
                        $imageFile->move(
                            $this->getParameter('images_directory'),    // dossier cible
                            $newFilename
                        );
                    } catch (FileException $e) {
                        // ... handle exception if something happens during file upload
                    }

                    // supprimer l'image d'avant
                    $dossierUpload = $this->getParameter('images_directory');
                    $fichierImage = "$dossierUpload/" . $user->getImageProfil();
                    if (is_file($fichierImage)) {
                        unlink($fichierImage);
                    }

                    $user->setImageProfil($newFilename);
                }



                $this->getDoctrine()->getManager()->flush();
                return $this->redirectToRoute('user_index');
            }

            return $this->render('user/edit.html.twig', [
                'user' => $user,
                'form' => $form->createView(),
            ]);
        } else {

            return $this->redirectToRoute('membre');
        }
    }
}
