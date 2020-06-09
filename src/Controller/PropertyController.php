<?php

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class PropertyController extends AbstractController
{

     private $repository;

     public function __construct(PropertyRepository $repository)
     {
          $this->repository = $repository;
     }

     /**
      * @Route("/buy", name="property_index")
      */
     public function index()
     {
          $properties = $this->repository->findAllVisible();

          return $this->render("property/index.html.twig", [
               "current_menu" => "buy",
               "properties" => $properties
          ]);

     }


     /**
      * @Route("/property/{slug}-{id}", name="property_show", requirements={"slug"= "[a-z0-9\-]*"})
      */
     public function show(string $slug, Property $property)
     {
          if($property->getSlug() !== $slug)
          {
               $this->redirectToRoute('property_show', [
                    'id' => $property->getId(),
                    'slug' => $property->getSlug()
               ]);
          }
          
          return $this->render("property/show.html.twig",[
               "property" => $property
          ]);

     }
}