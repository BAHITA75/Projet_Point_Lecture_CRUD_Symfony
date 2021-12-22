<?php

namespace App\Controller;

use App\Entity\Livre;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SingleLivreController extends AbstractController
{
    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/single/livre/{id}", name="single_livre")
     */
    public function viewLivre($id): Response
    {
        $singleLivre = $this->entityManager->getRepository(Livre::class)->find($id);
        return $this->render('single_livre/viewLivre.html.twig', [
            'singleLivre' => $singleLivre,
            ]);
    }
}
