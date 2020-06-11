<?php

namespace App\Controller;

use App\Entity\Property;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use App\Repository\PropertyRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;

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
     public function index(PaginatorInterface $paginator, Request $request)
     {
          $search = new PropertySearch();
          $form = $this->createForm(PropertySearchType::class, $search);
          $form->handleRequest($request);


          $query = $this->repository->findAllVisible($search);

          $pagination = $paginator->paginate(
               $query,
               $request->query->getInt('page', 1),
               9
          );

          return $this->render("property/index.html.twig", [
               "current_menu" => "buy",
               "pagination" => $pagination,
               "form" => $form->createView()
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