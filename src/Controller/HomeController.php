<?php

namespace App\Controller;

use App\Entity\Livre;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/", name="home")
     */
    public function home(): Response
    {     
        $livres = $this->entityManager->getRepository(Livre::class)->findAll(); 
        return $this->render('home/home.html.twig', [
            'livres' => $livres,
        ]);
    }

    /**
     * @Route("/home", name="redirectUser")
     */
    public function redirectToUser(): Response
    {
        $role = $this->getUser()->getRole();
        switch($role) {
            case 'Admin':
                return $this->redirectToRoute('dashboard');
                break;
            case 'User':
                return $this->redirectToRoute('account');
                break;
        }
    }     
}
