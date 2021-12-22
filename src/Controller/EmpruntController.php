<?php

namespace App\Controller;

use App\Entity\Emprunt;
use App\Form\EmpruntType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmpruntController extends AbstractController
{
    public function __construct(EntityManagerInterface $entityManager) 
    {
        $this->entityManager = $entityManager;  
    }
    /**
     * @Route("/admin/dashboard/gestionEmprunt/Ajout-Emprunt", name="ajout_emprunt")
     */
    public function emprunt(Request $request): Response
    {
        $emprunt = new Emprunt(); 
        $form = $this->createForm(EmpruntType::class, $emprunt); 
        $form->handleRequest($request);
        $dateEmprunt = $emprunt->getDateemprunt(new \DateTime());
        if($form->isSubmitted() && $form->isValid()){  
            
            $emprunt = $form->getData();  

            $emprunt->setDateemprunt(new \DateTime());
            $dateEmprunt = $emprunt->getDateemprunt(new \DateTime());

            $this->entityManager->persist($emprunt); 
            $this->entityManager->flush();   
            
            
            $this->addFlash('success',' L\'emprunt a été ajouté !');
            
            return $this->redirect($request->get('redirect') ?? '/admin/dashboard/gestionEmprunt');
        }
            return $this->render('emprunt/emprunt.html.twig', [
                'form' => $form->createView(),   
            ]);
    }
}
