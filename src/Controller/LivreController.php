<?php

namespace App\Controller;

use App\Entity\Livre;
use App\Form\LivreType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LivreController extends AbstractController
{
    public function __construct(EntityManagerInterface $entityManager) 
    {
        $this->entityManager = $entityManager;  
    }
    /**
     * @Route("/admin/livre", name="livre")
     */
    public function livre(Request $request): Response
    {
        $livre = new Livre(); 
        $form = $this->createForm(LivreType::class, $livre); 
        $form->handleRequest($request);
        $date = $livre->getAnneeEdition(new \DateTime());
        if($form->isSubmitted() && $form->isValid()){  
            
            $livre = $form->getData();  

            $this->entityManager->persist($livre);  
            $this->entityManager->flush();   
            
            
            $this->addFlash('success',' Le livre a été ajouté !');
            
            return $this->redirect($request->get('redirect') ?? '/admin/dashboard');
        }
            return $this->render('livre/livre.html.twig', [
                'form' => $form->createView(),   
            ]);
    }
}
