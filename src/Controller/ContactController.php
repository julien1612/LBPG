<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Attribute\Route;

final class ContactController extends AbstractController
{ 

    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contactData = $form->getData();

            $email = (new TemplatedEmail())
                ->from('noreply@tonsite.fr') // CONSEIL : Utilise une adresse de ton domaine ici
                ->replyTo($contactData['email']) 
                ->to('contact@trait-d-union.fr')
                ->subject('Nouveau message de contact : ' . $contactData['nom'])
                ->htmlTemplate('emails/contact_email.html.twig')
                ->context([
                    'prenom' => $contactData['prenom'],
                    'nom' => $contactData['nom'],
                    'mail_visiteur' => $contactData['email'],
                    'message' => $contactData['message'],
                    'statut' => $contactData['vous_etes'],
                ]);

            $mailer->send($email);

            $this->addFlash('success', 'Votre message a bien été envoyé à l\'association !');

            return $this->redirectToRoute('app_contact');
        }

        return $this->render('contact/contact.html.twig', [
            'contactForm' => $form->createView(), 
        ]);
    }
} 