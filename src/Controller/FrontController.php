<?php

namespace App\Controller;

use App\Form\ContactType;
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
    public function index(ProjectRepository $repoProject, Request $request, MailerInterface $mailer): Response
    {
        $contact = $this->createForm(ContactType::class);
        $contact->handleRequest($request);

        if($contact->isSubmitted() && $contact->isValid()) {
            
            $mail = (new TemplatedEmail())
            ->to(New Address("contact@guillaume-robert-webdev.fr"))
            ->from('contact@portfolio.fr')
            ->subject('Contact portfolio')
            ->htmlTemplate('email/contact.html.twig')
            ->text($contact->get('content')->getData())
            ->html('<p>See Twig integration for better HTML integration!</p>')
            ->context([
                "content" => $contact->get('content')->getData()
            ]);

            $mailer->send($mail);
        }
        

        return $this->render('front/index.html.twig', [
            'controller_name' => 'FrontController',
            'contactForm' => $contact->createView()
        ]);
    }
}
