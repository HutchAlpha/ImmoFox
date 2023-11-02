<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Property;
use Doctrine\ORM\EntityManagerInterface;


class PropertyController extends AbstractController
{
    private $entityManager; 

    public function __construct(EntityManagerInterface $entityManager) 
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/properties", name="property.index")
     */
    public function show(): Response
    {
        // Récupérer une entité Property existante en fonction de son ID (par exemple, ID 1)
        $existingProperty = $this->entityManager->getRepository(Property::class)->find(1);
        $properties = $this->entityManager->getRepository(Property::class)->findAll();
    
        if (!$existingProperty) {
            // Si l'entité avec ID 1 n'existe pas, créez une nouvelle
            $property = new Property();
           
        } else {
            // Si l'entité existe, utilisez-la
            $property = $existingProperty;
        }
    
        return $this->render('pages/property.html.twig', [
            'property' => $property,
            'properties' => $properties,
        ]);
    }
}    