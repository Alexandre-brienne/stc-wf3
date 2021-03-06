<?php

namespace App\Controller;


use App\Entity\User;
use App\Form\EditProfilType;
use App\Form\UserType;
use App\Repository\UserRepository;
use DateTime;
use App\Entity\Messagerie;
use App\Form\MessagerieType;
use App\Repository\MessagerieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\JsonSerializableNormalize;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


#[Route('/membre')]
class MembreController extends AbstractController 
{
    #[Route('/', name: 'membre')]
    public function index(AuthenticationUtils $authenticationUtils, UserRepository $userRepository): Response
    {

        $id = $this->getUser()->getid();
        $date = new DateTime();
        $userRepository->editdateconexion($id, $date->format('Y-m-d H:i:s'));
        $membres = $userRepository->findAll();
        



        return $this->render('membre/index.html.twig', [
            'controller_name' => 'MembreController',
            "membres" => $membres
        ]);
    }

    #[Route('/profil/{username}', name: 'profil', methods: ['GET'])]
    public function profil(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/mp/{username}', name: 'boitemessagerie', methods: ['GET'])]
    public function boitemessage(user $user,MessagerieRepository $messagerieRepository): Response
    {
        $messagerie = new Messagerie();
        $userConnecte = $this->getUser();
        $userMessagerie = $user->getId();

        if ($userConnecte->getid() == $userMessagerie){
        return $this->render('messagerie/index.html.twig', [
            'messageries' => $messagerieRepository->boiteuser($userConnecte),
        ]);
    }    
        }
        

    #[Route('/mp/{username}/{iduser}', name: 'messagerieduo', methods: ['GET', 'POST'])]
    public function messagerieduo(Request $request, User $user, UserRepository $userRepository, MessagerieRepository $messagerieRepository, $iduser): Response
    {
        
        $messagerie = new Messagerie();
        $userConnecte = $this->getUser();
        $userConnecte2 = $this->getUser()->getUsername();
        $userMessagerie = $user->getId();
        $destinataire = $userRepository->find(7);
        $form = $this->createForm(MessagerieType::class, $messagerie);
        $form->handleRequest($request);
        if ($userConnecte->getid() == $userMessagerie) {

            if ($form->isSubmitted() && $form->isValid()) {

                // $messagerie->setExpediteurId(5);
                // $messagerie->setDestinataireId(2);
                $objetDate = new \DateTime();
                $messagerie->setDateEnvoi($objetDate);
                $messagerie->setExpediteur($userConnecte);

                $destinataire = $userRepository->find($iduser);

                dump($destinataire);

                if ($destinataire != null) {
                    $messagerie->setDestinataire($destinataire);
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($messagerie);
                    $entityManager->flush();
                }
            }

            return $this->render('messagerie/messageduo.html.twig', [

                'messageries' => $messagerieRepository->MpUser($userConnecte, $iduser),
                'form' => $form->createView(),
                'userid' => intval($iduser)
                

            ]);
        }
    }

    #[Route('/test', name: 'sendmessage', methods: ['GET','POST'])]
    public function sendmessage(UserRepository $userRepository,Request $request,MessagerieRepository $messagerieRepository): Response
    {   

       
        $userConnecte = $this->getUser();
        $userConnecte2 = $this->getUser()->getUsername();
 
        
        $message = $request->get('message');
        $userid = $request->get('userid');
        $destinataire = $userRepository->find($userid);
        // dump($userid);
        if (!empty($message)){
          
            $messagerie = new Messagerie();
            $objetDate = new \DateTime();
            $messagerie->setDateEnvoi($objetDate);
            $messagerie->setMessage($message);
            $messagerie->setDestinataire($destinataire);
            $messagerie->setExpediteur($userConnecte);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($messagerie);
            $entityManager->flush();


        }

        

        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $seralizer = new Serializer($normalizers,$encoders);


        $messagerieRepository->MpUser($userConnecte,$destinataire);
        
        $messages = [];
        $messages2 = $messagerieRepository->MpUser($userConnecte,$destinataire);
        foreach ($messages2 as $message){
            $messages[] = [
                'expediteur' =>  $message->getExpediteur()->getUsername(),
                'message' => $message->getMessage(), 
                'date' => $message->getDateEnvoi(),
            ];
        };

        $message = $messagerieRepository->MpUser($userConnecte,$destinataire);
        $response = new JsonResponse([
                'content' =>  $message

        ]);

        dump($message);
        $response->setData([
            'data' => 123,
            // 'messages' => $messagerieRepository->findAll(),

            'expediteur' => $userConnecte2,
            'messages' => $messages
        
        ]);
            
        return $response;
        

        }
        


    // #[Route('/mp/{username}', name: 'messagerieduo', methods: ['GET'])]
    // public function messagerieduo(User $user, MessagerieRepository $messagerieRepository): Response
    // {
    //     $userConnecte = $this->getUser();
    //     $userMessagerie = $user->getId();
    //     if ($userConnecte->getid() == $userMessagerie) {

    //         return $this->render('messagerie/messageduo.html.twig', [

    //             'messageries' => $messagerieRepository->test(2),

    //         ]);
    //     }
    // }


    #[Route('/profil/{username}/edit', name: 'profil_edit', methods: ['GET', 'POST'])]

    public function edit(Request $request, User $user, SluggerInterface $slugger): Response
    {
        $userConnecte = $this->getUser();
        $userprofil = $user->getId();
        $userImage = $user->getImageProfil();
        if ($userConnecte->getid() == $userprofil) {

            $form = $this->createForm(EditProfilType::class, $user);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $imageFile = $form->get('image_profil')->getData();

                if ($imageFile) {
                    $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                    $safeFilename = $slugger->slug($originalFilename);
                    $newFilename  = $safeFilename . md5(uniqid()) . '.' . $imageFile->guessExtension();
                    try {
                        $dossierUpload = $this->getParameter('images_directory');
                        $fichierImageold = "$dossierUpload/$userImage";
                        if ($user->getImageProfil() != $newFilename) {
                            if (is_file($fichierImageold)) {
                                unlink($fichierImageold);
                            }
                            $imageFile->move($dossierUpload, $newFilename);
                            $user->setImageProfil($newFilename);
                        } elseif ($user->getImageProfil() === NULL) {
                            $imageFile->move($dossierUpload, $newFilename);
                            $user->setImageProfil($newFilename);
                        }
                    } catch (FileException $e) {
                        // ... handle exception if something happens d uring file upload
                    }
                }



                $this->getDoctrine()->getManager()->flush();
                // return $this->redirectToRoute('membre');
            }
            dump($user);
            return $this->render('user/edit.html.twig', [
                'user' => $user,
                'form' => $form->createView(),
            ]);
        } else {

            return $this->redirectToRoute('membre');

            
        }
    }
}
