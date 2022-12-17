<?php

namespace App\Controller;

use App\Entity\Students;
use App\Form\StudentsType;
use App\Repository\StudentsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/students')]
class StudentsController extends AbstractController
{
    #[Route('/', name: 'app_students_index', methods: ['GET'])]
    public function index(StudentsRepository $studentsRepository): Response
    {
        return $this->render('students/index.html.twig', [
            'students' => $studentsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_students_new', methods: ['GET', 'POST'])]
    public function new(Request $request, StudentsRepository $studentsRepository): Response
    {
        $student = new Students();
        $form = $this->createForm(StudentsType::class, $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $studentsRepository->save($student, true);

            return $this->redirectToRoute('app_students_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('students/new.html.twig', [
            'student' => $student,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_students_show', methods: ['GET'])]
    public function show(Students $student): Response
    {
        return $this->render('students/show.html.twig', [
            'student' => $student,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_students_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Students $student, StudentsRepository $studentsRepository): Response
    {
        $form = $this->createForm(StudentsType::class, $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $studentsRepository->save($student, true);

            return $this->redirectToRoute('app_students_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('students/edit.html.twig', [
            'student' => $student,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_students_delete', methods: ['POST'])]
    public function delete(Request $request, Students $student, StudentsRepository $studentsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$student->getId(), $request->request->get('_token'))) {
            $studentsRepository->remove($student, true);
        }

        return $this->redirectToRoute('app_students_index', [], Response::HTTP_SEE_OTHER);
    }
}
