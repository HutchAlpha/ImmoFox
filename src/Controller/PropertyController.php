<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Property; // Assurez-vous d'importer la classe Property
use Doctrine\ORM\EntityManagerInterface; // Import de l'EntityManager

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
        $property = new Property();
        $property->setTitle('Mon premier bien')
            ->setDescription('Ceci est un logement à vendre')
            ->setPrice(100000)
            ->setRooms(6)
            ->setBedrooms(3)
            ->setSurface(60)
            ->setFloor(1)
            ->setHeat(1)
            ->setCity('Cherbourg-En-Cotentin')
            ->setAddress('8 rue des Pommiers')
            ->setPostalCode(50100);
            $property->setSold(false);


        $this->entityManager->persist($property);
        $this->entityManager->flush();

        return $this->render('pages/property.html.twig');
    }
}
