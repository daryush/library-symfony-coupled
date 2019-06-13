<?php

namespace App\Controller;

use App\Entity\BookBorrowing;
use App\Form\BookBorrowingType;
use App\Repository\BookBorrowingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/book/borrowing")
 */
class BookBorrowingController extends AbstractController
{
    /**
     * @Route("/", name="book_borrowing_index", methods={"GET"})
     */
    public function index(BookBorrowingRepository $bookBorrowingRepository): Response
    {
        return $this->render('book_borrowing/index.html.twig', [
            'book_borrowings' => $bookBorrowingRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="book_borrowing_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $bookBorrowing = new BookBorrowing();
        $form = $this->createForm(BookBorrowingType::class, $bookBorrowing);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bookBorrowing);
            $entityManager->flush();

            return $this->redirectToRoute('book_borrowing_index');
        }

        return $this->render('book_borrowing/new.html.twig', [
            'book_borrowing' => $bookBorrowing,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="book_borrowing_show", methods={"GET"})
     */
    public function show(BookBorrowing $bookBorrowing): Response
    {
        return $this->render('book_borrowing/show.html.twig', [
            'book_borrowing' => $bookBorrowing,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="book_borrowing_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, BookBorrowing $bookBorrowing): Response
    {
        $form = $this->createForm(BookBorrowingType::class, $bookBorrowing);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('book_borrowing_index', [
                'id' => $bookBorrowing->getId(),
            ]);
        }

        return $this->render('book_borrowing/edit.html.twig', [
            'book_borrowing' => $bookBorrowing,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="book_borrowing_delete", methods={"DELETE"})
     */
    public function delete(Request $request, BookBorrowing $bookBorrowing): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bookBorrowing->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($bookBorrowing);
            $entityManager->flush();
        }

        return $this->redirectToRoute('book_borrowing_index');
    }
}
