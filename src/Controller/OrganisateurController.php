<?php

// src/Controller/OrganisateurController.php

namespace App\Controller;

use App\Entity\Organisateur; // Ajoutez cette ligne pour importer la classe Organisateur
use App\Form\OrganisateurFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrganisateurController extends AbstractController

{
    #[Route('/organisateur', name: 'app_organisateur')]
    public function organisateur(Request $request): Response
    {
        $organisateur = new Organisateur();

        $form = $this->createForm(OrganisateurFormType::class, $organisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérez les données du formulaire
            $organisateur = $form->getData();

            // Enregistrez les données dans la base de données
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($organisateur);
            $entityManager->flush();

            // Redirigez l'utilisateur ou affichez un message de succès
            return $this->redirectToRoute('evenement');
        }

        return $this->render('organisateur/organisateur.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
