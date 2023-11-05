<?php

namespace App\Controller\Admin;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    private $repository;

    public function __construct(PropertyRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/admin/", name="admin.index")
     */
    public function index()
    {
        $properties = $this->repository->findAll();
        return $this->render('admin/admindex.html.twig', compact('properties'));
    }

    /**
     * @Route("/admin/{id}", name="admin.edit")
     */
    public function edit(Property $property)
    {
        return $this->render('admin/edit.html.twig', compact('property'));
    }
}
