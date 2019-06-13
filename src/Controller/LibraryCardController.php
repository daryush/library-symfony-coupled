<?php

namespace App\Controller;

use App\Entity\LibraryCard;
use App\Form\LibraryCardType;
use App\Repository\LibraryCardRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/library/card")
 */
class LibraryCardController extends AbstractController
{
    /**
     * @Route("/", name="library_card_index", methods={"GET"})
     */
    public function index(LibraryCardRepository $libraryCardRepository): Response
    {
        return $this->render('library_card/index.html.twig', [
            'library_cards' => $libraryCardRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="library_card_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $libraryCard = new LibraryCard();
        $form = $this->createForm(LibraryCardType::class, $libraryCard);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($libraryCard);
            $entityManager->flush();

            return $this->redirectToRoute('library_card_index');
        }

        return $this->render('library_card/new.html.twig', [
            'library_card' => $libraryCard,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="library_card_show", methods={"GET"})
     */
    public function show(LibraryCard $libraryCard): Response
    {
        return $this->render('library_card/show.html.twig', [
            'library_card' => $libraryCard,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="library_card_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, LibraryCard $libraryCard): Response
    {
        $form = $this->createForm(LibraryCardType::class, $libraryCard);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('library_card_index', [
                'id' => $libraryCard->getId(),
            ]);
        }

        return $this->render('library_card/edit.html.twig', [
            'library_card' => $libraryCard,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="library_card_delete", methods={"DELETE"})
     */
    public function delete(Request $request, LibraryCard $libraryCard): Response
    {
        if ($this->isCsrfTokenValid('delete'.$libraryCard->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($libraryCard);
            $entityManager->flush();
        }

        return $this->redirectToRoute('library_card_index');
    }
}
