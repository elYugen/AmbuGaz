<?php

namespace App\Controller;

use App\Entity\Disinfections;
use App\Form\DisinfectionsType;
use App\Repository\DisinfectionsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/disinfections')]
final class DisinfectionsController extends AbstractController
{
    #[Route(name: 'app_disinfections_index', methods: ['GET'])]
    public function index(DisinfectionsRepository $disinfectionsRepository): Response
    {
        return $this->render('disinfections/index.html.twig', [
            'disinfections' => $disinfectionsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_disinfections_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $disinfection = new Disinfections();
        $form = $this->createForm(DisinfectionsType::class, $disinfection);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($disinfection);
            $entityManager->flush();

            return $this->redirectToRoute('app_disinfections_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('disinfections/new.html.twig', [
            'disinfection' => $disinfection,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_disinfections_show', methods: ['GET'])]
    public function show(Disinfections $disinfection): Response
    {
        return $this->render('disinfections/show.html.twig', [
            'disinfection' => $disinfection,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_disinfections_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Disinfections $disinfection, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DisinfectionsType::class, $disinfection);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_disinfections_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('disinfections/edit.html.twig', [
            'disinfection' => $disinfection,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_disinfections_delete', methods: ['POST'])]
    public function delete(Request $request, Disinfections $disinfection, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$disinfection->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($disinfection);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_disinfections_index', [], Response::HTTP_SEE_OTHER);
    }
}
