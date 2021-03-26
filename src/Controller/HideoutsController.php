<?php

namespace App\Controller;

use App\Entity\Hideouts;
use App\Form\AddHideoutType;
use App\Repository\HideoutsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HideoutsController extends AbstractController
{
    #[Route('/hideouts', name: 'hideouts_index')]
    public function index(HideoutsRepository $hideoutsRepository): Response
    {
        return $this->render('hideouts/index.html.twig', [
            'hideouts' => $hideoutsRepository->findAll(),
        ]);
    }

    /**
     * @Route ("/hideouts/{id}", name="hideout_details")
     */
    public function showHideout(int $id, HideoutsRepository $hideoutsRepository): Response
    {
        return $this->render('hideouts/showHideout.html.twig', [
            'hideout' => $hideoutsRepository->find($id),
        ]);
    }

    /**
     * @Route ("/hideouts-add", name="hideout_add")
     */
    public function addSkill(Request $request): Response
    {
        $hideout = new Hideouts();
        $form = $this->createForm(AddHideoutType::class, $hideout);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($hideout);
            $entityManager->flush();

            return $this->redirectToRoute('hideouts_index');
        }

        return $this->render('hideouts/addHideout.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route ("/hideouts/{id}/update", name="hideout_update", methods={"GET", "POST"})
     */
    public function updateHideout(Request $request, Hideouts $hideout): Response
    {
        $form = $this->createForm(AddHideoutType::class, $hideout);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('hideouts_index');
        }

        return $this->render('hideouts/editHideout.html.twig', [
            'hideout' => $hideout,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route ("/hideouts/{id}/delete", name="hideout_delete", methods={"GET"})
     */
    public function deleteContact(int $id, HideoutsRepository $hideoutsRepository): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $hideout = $hideoutsRepository->find($id);
        if (!$hideout) {
            return $this->redirectToRoute('hideouts_index');
        }

        $entityManager->remove($hideout);
        $entityManager->flush();

        return $this->redirectToRoute('hideouts_index');
    }
}
