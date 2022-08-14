<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Repository\ConfigRepository;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mailer\Mailer;
use App\Repository\ProjectRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FrontController extends AbstractController
{
    #[Route('/', name: 'app_front')]
    public function index(ProjectRepository $repoProject, ConfigRepository $repoConfig,  Request $request, MailerInterface $mailer): Response
    { 
        
        $config = $repoConfig->findAll()[0] ;
        $projects = $repoProject->findAll();

        $now = new \DateTime(date('Y-m-d'));
        $birth = date_create_from_format('d/m/Y', $config->getBirthDate());
        $age = $now->diff($birth, true)->format('%Y');
         
        $contact = $this->createForm(ContactType::class);
        $contact->handleRequest($request);

        if($contact->isSubmitted() && $contact->isValid()) {
            $contactFormData = $contact->getData();
            $mail = (new TemplatedEmail())
            ->to(New Address("contact@guillaume-robert-webdev.fr"))
            ->from('contact@guillaume-robert-webdev.fr')
            ->subject('Contact portfolio')
            ->htmlTemplate('email/contact.html.twig')
            ->context([
                'nom' => $contactFormData['nom'],
                'prenom' =>$contactFormData['prenom'],
                "adressMail" => $contactFormData['adressMail'],
                'sujet' =>$contactFormData['sujet'],
                'content' =>$contactFormData['content']
            ]);

            $mailer->send($mail);

            $this->addFlash('success', 'Votre message a bien été envoyé');
            $this->redirectToRoute('app_front');
        }

        
        

        return $this->render('front/index.html.twig', [
            'controller_name' => 'FrontController',
            'contactForm' => $contact->createView(),
            'projects' => $projects, 
            'config' => $config,
            'age' => $age
        ]); 
    }


    #[Route("/mentions-legales", name:"mentions_legales")]
    public function mentions_legales (ConfigRepository $repoConfig) {
        $config = $repoConfig->findAll()[0];

        return $this->render('front/mentions-legales.html.twig', [
            'config' => $config
        ]);
    }

}