<?php

namespace App\Controller;

use App\Entity\Targets;
use App\Form\AddTargetType;
use App\Repository\ContactsRepository;
use App\Repository\TargetsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TargetsController extends AbstractController
{
    #[Route('/targets', name: 'targets_index')]
    public function index(TargetsRepository $targetsRepository): Response
    {
        return $this->render('targets/index.html.twig', [
            'targets' => $targetsRepository->findAll(),
        ]);
    }

    /**
     * @Route ("/targets/{id}", name="target_details")
     */
    public function showAgent(int $id, TargetsRepository $targetsRepository): Response
    {
        return $this->render('targets/showTarget.html.twig', [
            'target' => $targetsRepository->find($id),
        ]);
    }

    /**
     * @Route ("/targets-add", name="target_add")
     */
    public function addTarget(Request $request): Response
    {
        $target = new Targets();
        $form = $this->createForm(AddTargetType::class, $target);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($target);
            $entityManager->flush();

            return $this->redirectToRoute('targets_index');
        }

        return $this->render('targets/addTarget.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route ("/targets/{id}/update", name="target_update", methods={"GET", "POST"})
     */
    public function updateContact(Request $request, Targets $target): Response
    {
        $form = $this->createForm(AddTargetType::class, $target);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('targets_index');
        }

        return $this->render('targets/editTarget.html.twig', [
            'target' => $target,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route ("/targets/{id}/delete", name="target_delete", methods={"GET"})
     */
    public function deleteContact(int $id, TargetsRepository $targetsRepository): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $target = $targetsRepository->find($id);
        if (!$target) {
            return $this->redirectToRoute('targets_index');
        }

        $entityManager->remove($target);
        $entityManager->flush();

        return $this->redirectToRoute('targets_index');
    }
}
