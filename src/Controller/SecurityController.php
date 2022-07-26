<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Config;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SecurityController extends AbstractController
{
    #[Route('/security', name: 'app_security')]
    public function index(): Response
    {
        return $this->render('security/index.html.twig', [
            'controller_name' => 'SecurityController',
        ]);
    }

    #[Route('/registration' , name:'inscription')]
    public function regitration(Request $request, User $user = null, EntityManagerInterface $manager, UserPasswordHasherInterface $passwordHasher ) {
        $user = new User();
        $form = $this->createForm(UserType::class , $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $hashedpassword = $passwordHasher->hashPassword($user , $user->getPassword());

            $user->setPassword($hashedpassword);
            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('security_login');
        }

        return $this->render('security/registration.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/connexion', name:'security_login')]
    public function login(UserRepository $userRepo)
    {
        $user = $userRepo->findAll();
        if(empty($user))
        {
            return $this->redirectToRoute('inscription');
        }

        return $this->render('security/login.html.twig' , [
         'titlePage' => 'Connexion'
        ]);
    }

    #[Route('/logout', name:'security_logout')]
    public function logout() {
        
    }
}
