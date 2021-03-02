<?php

namespace App\Controller;

use App\Entity\contact;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Form\ContactType;
use App\Form\UserType;
use App\Repository\UserRepository;
use App\Form\RegistrationFormType;
use App\Security\LoginFormAuthenticator;
use Symfony\Component\PropertyAccess\PropertyAccessor as property ;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SiteController extends AbstractController
{
    #[Route('/', name: 'site')]
    public function index(AuthenticationUtils $authenticationUtils,UserRepository $userRepository): Response
    {   
        if ($this->getUser()) {
            return $this->redirectToRoute('membre');
        }

        $membres = $userRepository->select5user(); 
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('site/index.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
            "membres" =>$membres,
           
        ]);
    }
    

    


    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, LoginFormAuthenticator $authenticator): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $user->setRoles(["ROLE_USER"]);
            $user->setSexe("homme");
            $user->setNom("alexandre");
            $user->setPrenom("toto");
            // $user->setPoint(10);

            // $user->setAmisId(5);
         
            $user->setDateInscription(new \DateTime());
            // $user->setDateNaissance(new \DateTime());


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

}
