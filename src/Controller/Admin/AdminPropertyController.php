<?php

namespace App\Controller\Admin;

use App\Entity\Property;
use App\Form\PropertyType;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminPropertyController extends AbstractController
{

     private $repository;

     private $em;

     public function __construct(PropertyRepository $repository, EntityManagerInterface $em)
     {
          $this->repository = $repository;
          $this->em = $em;
     }


     /**
      * @Route("/admin", name="admin_property_index")
      */
     public function index()
     {
          $properties = $this->repository->findAll();

          return $this->render("admin/property/index.html.twig",[
               "current_menu" => "admin",
               "properties" => $properties
          ]);
     }


     /**
      * @Route("/admin/create", name="admin_property_create")
      */
     public function create(Request $request)
     {
          $property = new Property();
          $form = $this->createForm(PropertyType::class, $property);
          $form->handleRequest($request);

          if($form->isSubmitted() && $form->isValid())
          {
              $this->em->persist($property);
              $this->addFlash("success", "Bien ajouté avec succès");
              $this->em->flush();

              return $this->redirectToRoute("admin_property_index");
          }

          return $this->render("admin/property/create.html.twig", [
               "form" => $form->createView()
          ]);
     }


     /**
      * @Route("/admin/edit/{id}" , name="admin_property_edit")
      */
     public function edit(Property $property, Request $request)
     {
          $form = $this->createForm(PropertyType::class, $property);
          $form->handleRequest($request);

          if($form->isSubmitted() && $form->isValid())
          {
               $this->em->flush();
               $this->addFlash("success", "Le bien a été modifier avec succès");

               return $this->redirectToRoute("admin_property_index");
          }

         return $this->render("admin/property/edit.html.twig", [
               "form" => $form->createView()
         ]);
     }


     /**
      * @Route("/admin/delete/{id}", name="admin_property_delete", methods="DELETE")
      */
     public function delete(Property $property, Request $request)
     {
          if($this->isCsrfTokenValid('delete'. $property->getId(), $request->get('_token')))
          {
               $this->em->remove($property);
               $this->em->flush();
               $this->addFlash("success", "Le bien a été supprimer avec succès");

               return $this->redirectToRoute("admin_property_index");
          }
     }
}