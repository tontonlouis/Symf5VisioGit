<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Property;
use App\Form\ContactType;
use App\Notification\ContactNotification;
use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    /**
     * @Route("/", name="home")
     */
    public function home(): Response
    {
        
        $repository = $this->getDoctrine()->getRepository(Property::class);
        
        $properties = $repository->findLastProperty();

        return $this->render("home/home.html.twig", [
            "current_menu" => "home",
            "properties" => $properties
        ]);
        
    }

    /**
     * @Route("/contact", name="home_contact")
     */
    public function contact(Request $request, ContactNotification $notification)
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $notification->notify($contact);
            $this->addFlash('success', 'Email envoyé avec succès');
        }

        return $this->render('home/contact.html.twig', [
            "form" => $form->createView(),
            "current_menu" => "contact"
        ]);
    }
}