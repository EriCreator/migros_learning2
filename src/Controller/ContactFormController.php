<?php

namespace App\Controller;

use App\Form\ContactFormType;
use Swift_Mailer;
use Swift_Message;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ContactFormController extends AbstractController
{
    /**
     * @Route("/contact", name="contact_form")
     * @param Request $request
     * @param Swift_Mailer $mailer
     * @return Response
     */
    public function index(Request  $request, Swift_Mailer $mailer)
    {
        $form = $this->createForm(ContactFormType::class);

        $form->handleRequest($request);

        $this->addFlash('info', 'Random Flash testing');

        if($form->isSubmitted() && $form->isValid()){

            $contactFormData = $form->getData();

            $msgString = "".$contactFormData['name']." <br> ".$contactFormData['from']."<br>".($contactFormData['dateOfBirth']->format('d. F Y'))." <br> ".$contactFormData['message'];

            $message = (new Swift_Message('You got an email!'))
                ->setFrom($contactFormData['from'])
                ->setTo('eric.is.learning.symfony@gmail.com')
                ->setBody(
                    $msgString,
                    'text/html'
                );

            $mailer->send($message);


            $this->addFlash('success', 'You successfully received an email.');

            return $this->redirectToRoute('contact_form');
        }

        return $this->render('contact_form/index.html.twig',[
            'my_form' => $form->createView(),
        ]);
    }


}
