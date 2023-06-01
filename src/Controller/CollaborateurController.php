<?php

namespace App\Controller;

use App\Entity\Collaborateur;
use App\Form\CollaborateurType;
use App\Repository\CollaborateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/collaborateur')]
class CollaborateurController extends AbstractController
{
    #[Route('/', name: 'app_collaborateur_index', methods: ['GET'])]
    public function index(CollaborateurRepository $collaborateurRepository): Response
    {
        return $this->render('collaborateur/index.html.twig', [
            'collaborateurs' => $collaborateurRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_collaborateur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CollaborateurRepository $collaborateurRepository): Response
    {
        $collaborateur = new Collaborateur();
        $form = $this->createForm(CollaborateurType::class, $collaborateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $collaborateurRepository->save($collaborateur, true);

            return $this->redirectToRoute('app_collaborateur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('collaborateur/new.html.twig', [
            'collaborateur' => $collaborateur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_collaborateur_show', methods: ['GET'])]
    public function show(Collaborateur $collaborateur): Response
    {
        return $this->render('collaborateur/show.html.twig', [
            'collaborateur' => $collaborateur,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_collaborateur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Collaborateur $collaborateur, CollaborateurRepository $collaborateurRepository): Response
    {
        $form = $this->createForm(CollaborateurType::class, $collaborateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $collaborateurRepository->save($collaborateur, true);

            return $this->redirectToRoute('app_collaborateur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('collaborateur/edit.html.twig', [
            'collaborateur' => $collaborateur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_collaborateur_delete', methods: ['POST'])]
    public function delete(Request $request, Collaborateur $collaborateur, CollaborateurRepository $collaborateurRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$collaborateur->getId(), $request->request->get('_token'))) {
            $collaborateurRepository->remove($collaborateur, true);
        }

        return $this->redirectToRoute('app_collaborateur_index', [], Response::HTTP_SEE_OTHER);
    }
}
