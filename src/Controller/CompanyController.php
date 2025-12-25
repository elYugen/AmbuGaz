<?php

namespace App\Controller;

use App\Entity\Company;
use App\Form\CompanyType;
use App\Repository\CompanyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/company')]
#[IsGranted('IS_AUTHENTICATED_FULLY')]
final class CompanyController extends AbstractController
{
    #[Route(name: 'app_company_index', methods: ['GET'])]
    public function index(CompanyRepository $companyRepository): Response
    {
        $user = $this->getUser();
        
        // Seuls les DEV voient toutes les entreprises
        if ($this->isGranted('ROLE_DEV')) {
            $companies = $companyRepository->findAll();
        } else {
            // ADMIN et USER ne voient que leur entreprise
            $userCompany = $user->getCompany();
            $companies = $userCompany ? [$userCompany] : [];
        }

        return $this->render('company/index.html.twig', [
            'companies' => $companies,
        ]);
    }

    #[Route('/new', name: 'app_company_new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_DEV')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $company = new Company();
        $form = $this->createForm(CompanyType::class, $company);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($company);
            $entityManager->flush();

            $this->addFlash('success', 'Entreprise créée avec succès !');

            return $this->redirectToRoute('app_company_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('company/new.html.twig', [
            'company' => $company,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_company_show', methods: ['GET'])]
    public function show(Company $company): Response
    {
        // Vérifier que l'utilisateur peut voir cette entreprise
        if (!$this->canAccessCompany($company)) {
            $this->addFlash('error', 'Vous n\'avez pas accès à cette entreprise.');
            return $this->redirectToRoute('app_company_index');
        }

        return $this->render('company/show.html.twig', [
            'company' => $company,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_company_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Company $company, EntityManagerInterface $entityManager): Response
    {
        // Vérifier que l'utilisateur peut modifier cette entreprise
        if (!$this->canEditCompany($company)) {
            $this->addFlash('error', 'Vous n\'avez pas le droit de modifier cette entreprise.');
            return $this->redirectToRoute('app_company_index');
        }

        $form = $this->createForm(CompanyType::class, $company);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Entreprise modifiée avec succès !');

            return $this->redirectToRoute('app_company_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('company/edit.html.twig', [
            'company' => $company,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_company_delete', methods: ['POST'])]
    #[IsGranted('ROLE_DEV')]
    public function delete(Request $request, Company $company, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$company->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($company);
            $entityManager->flush();

            $this->addFlash('success', 'Entreprise supprimée avec succès !');
        }

        return $this->redirectToRoute('app_company_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * Vérifie si l'utilisateur peut accéder à cette entreprise
     */
    private function canAccessCompany(Company $company): bool
    {
        // Les DEV peuvent tout voir
        if ($this->isGranted('ROLE_DEV')) {
            return true;
        }

        // ADMIN et USER ne peuvent voir que leur entreprise
        $user = $this->getUser();
        return $user->getCompany() && $user->getCompany()->getId() === $company->getId();
    }

    /**
     * Vérifie si l'utilisateur peut modifier cette entreprise
     */
    private function canEditCompany(Company $company): bool
    {
        // Les DEV peuvent tout modifier
        if ($this->isGranted('ROLE_DEV')) {
            return true;
        }

        // Les ADMIN peuvent modifier LEUR entreprise
        if ($this->isGranted('ROLE_ADMIN')) {
            $user = $this->getUser();
            return $user->getCompany() && $user->getCompany()->getId() === $company->getId();
        }

        // Les USER ne peuvent rien modifier
        return false;
    }
}