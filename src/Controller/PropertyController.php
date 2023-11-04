<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Property;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

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
    public function index(): Response
    {
        $properties = $this->entityManager->getRepository(Property::class)->findAll();

        return $this->render('pages/property.html.twig', [
            'properties' => $properties,
        ]);
    }

   /**
 * @Route("/property/{id}", name="property.show")
 * @ParamConverter("property", class="App\Entity\Property")
 */
public function show(Property $property): Response
{
    if (!$property) {
        throw $this->createNotFoundException('Propriété non trouvée');
    }

    return $this->render('pages/property.show.html.twig', [
        'property' => $property,
    ]);
}
}