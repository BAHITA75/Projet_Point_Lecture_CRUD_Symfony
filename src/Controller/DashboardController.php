<?php

namespace App\Controller;

use App\Entity\Emprunt;
use App\Entity\Livre;
use App\Entity\User;
use App\Form\EditLivreType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/admin/dashboard", name="dashboard")
     */
    public function dashboard(): Response
    {
        return $this->render('dashboard/dashboard.html.twig');
    }
     /**
     * @Route("/admin/dashboard/gestion-livre", name="gestion_livre")
     */
    public function gestionLivre(): Response
    {
        $livres = $this->entityManager->getRepository(Livre::class)->findAll(); 
        return $this->render('dashboard/gestionLivre.html.twig', [
            'livres' => $livres,
        ]);
    }
      /**
     * @Route("/admin/dashboard/gestion-user", name="gestion_user")
     */
    public function gestionUser(): Response
    {
        $users = $this->entityManager->getRepository(User::class)->findAll();
        return $this->render('dashboard/gestionUser.html.twig', [
            'users' => $users,
        ]);
    }
      /**
     * @Route("/admin/dashboard/gestion-emprunt", name="gestion_emprunt")
     */
    public function gestionEmprunt(): Response
    {
        $emprunts = $this->entityManager->getRepository(Emprunt::class)->findAll();  
        return $this->render('dashboard/gestionEmprunt.html.twig', [
            'emprunts' => $emprunts,
        ]);
    }

     //  MODIFIER UN livre
     /**
     * @Route("/admin/edit/livre/{id}", name="edit_livre")
     */
    public function aditArticle($id, Request $request): Response
    {
        $livre = $this->entityManager->getRepository(Livre::class)->find($id);
        $form = $this->createForm(EditLivreType::class,$livre);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){  

            $this->entityManager->persist($livre);  
            $this->entityManager->flush();   
        
            $this->addFlash('success','Le Livre '. $id. ' a été modifié !');
            return $this->redirect($request->get('redirect') ?? '/admin/dashboard/gestion-livre'); 
        }
        
        return $this->render('dashboard/editLivre.html.twig', [
            'form' => $form->createView(),   
        ]);
    }

    //  SUPRIMMER UN livre
    /**
     * @Route("/admin/dashboard/delete-livre/{id}", name="delete_livre")
     */

    public function deleteArticle($id, Request $request): Response
    {
        $livre = $this->entityManager->getRepository(Livre::class)->find($id);
            $this->entityManager->remove($livre); 
            $this->entityManager->flush();
            $this->addFlash('success','Le livre '. $id. ' a été supprimé !');
            return $this->redirect($request->get('redirect') ?? '/admin/dashboard/gestion-livre'); 
    }

    //  SUPRIMMER UN LECTEUR
    /**
     * @Route("/admin/delete/user/{id}", name="delete_user")
     */

    public function deleteUser($id, Request $request): Response
    {
        $user = $this->entityManager->getRepository(User::class)->find($id);
            $this->entityManager->remove($user); 
            $this->entityManager->flush();
            $this->addFlash('success','Le lecteur '.'N°'. $id.' '.$user->getLastName().' '.$user->getFirstName(). ' a été supprimé !');
            return $this->redirect($request->get('redirect') ?? '/admin/dashboard/gestion-user'); 
    }
}
