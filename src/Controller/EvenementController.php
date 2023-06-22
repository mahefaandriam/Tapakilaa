<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Evenement;
use App\Form\EvenementFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use App\Repository\UsersRepository;
use App\Entity\Users;
use Doctrine\Persistence\ManagerRegistry;

class EvenementController extends AbstractController 
{
    private $managerRegistry;

    public function __construct(Security $security,ManagerRegistry $managerRegistry)
    {
        $this->security = $security;
        $this->managerRegistry = $managerRegistry;
    }

    #[Route('/evenement', name: 'app_evenement')]
    public function index(Request $request): Response
    {
         // Get the current authenticated user
    $user = $this->security->getUser();

    // Retrieve the user from the repository
    $repository = $this->managerRegistry->getRepository(Users::class);
    $user = $repository->find($user->getId());
        $organisateur = $user->getOrganisateur();
        
        $event = new Evenement();
        $form = $this->createForm(EvenementFormType::class, $event);
    
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Sauvegarder l'événement dans la base de données
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($event);
            $entityManager->flush();
    
            // Rediriger vers une page de confirmation ou autre
            return $this->redirectToRoute('evenement_confirmation');
        }
    
        if(!empty($organisateur)){
            return $this->render('evenement/evenement.html.twig', [
                'controller_name' => 'EvenementController',
                'form' => $form->createView(),
            ]);
        }
        else {
            return $this->redirectToRoute('app_organisateur');
        }
        
        
    }
}

