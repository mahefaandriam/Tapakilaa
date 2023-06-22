<?php

namespace App\Controller;

use App\Entity\Billet;
use App\Form\BilletFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BilletController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/billet/create', name: 'billet_create')]
    public function create(Request $request): Response
    {
        $billet = new Billet();
        $form = $this->createForm(BilletFormType::class, $billet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($billet);
            $this->entityManager->flush();

            return $this->redirectToRoute('billet_show', ['id' => $billet->getId()]);
        }

        return $this->render('billet/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/billet/{id}', name: 'billet_show')]
    public function show(Billet $billet): Response
    {
        return $this->render('billet/billet.html.twig', [
            'billet' => $billet,
        ]);
    }
}
