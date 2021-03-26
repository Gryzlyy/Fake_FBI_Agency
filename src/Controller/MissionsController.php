<?php

namespace App\Controller;

use App\Entity\Missions;
use App\Form\AddMissionType;
use App\Repository\ContactsRepository;
use App\Repository\MissionsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MissionsController extends AbstractController
{
    #[Route('/', name: 'app.home')]
    public function index(MissionsRepository $missionsRepository): Response
    {
        return $this->render('missions/index.html.twig', [
            'missions' => $missionsRepository->findAll(),
        ]);
    }

    /**
     * @Route ("/missions/{id}", name="mission_details")
     */
    public function showMission(int $id, MissionsRepository $missionsRepository): Response
    {
        return $this->render('missions/showMission.html.twig', [
            'mission' => $missionsRepository->find($id),
        ]);
    }

    /**
     * @Route ("/missions-add", name="mission_add")
     */
    public function addMission(Request $request): Response
    {
        $mission = new Missions();
        $form = $this->createForm(AddMissionType::class, $mission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (!$mission->isMissionValid()) {
                $this->addFlash('error', 'The mission "'.$mission->getTitle().'" previously created does not contains valids items. Please read the constraints and retry.');
                return $this->redirectToRoute('app.home');
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($mission);
            $entityManager->flush();

            return $this->redirectToRoute('app.home');
        }

        return $this->render('missions/addMission.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route ("/missions/{id}/update", name="mission_update", methods={"GET", "POST"})
     */
    public function updateMission(Request $request, Missions $mission): Response
    {
        $form = $this->createForm(AddMissionType::class, $mission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (!$mission->isMissionValid()) {
                $this->addFlash('error', 'This mission '.$mission->getTitle().' does not contains valids items. Please read the constraints and retry.');
                return $this->redirectToRoute('app.home');
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('app.home');
        }

        return $this->render('missions/editMission.html.twig', [
            'mission' => $mission,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route ("/missions/{id}/delete", name="mission_delete", methods={"GET"})
     */
    public function deleteMission(int $id, MissionsRepository $missionsRepository): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $mission = $missionsRepository->find($id);
        if (!$mission) {
            return $this->redirectToRoute('app.home');
        }

        $entityManager->remove($mission);
        $entityManager->flush();

        return $this->redirectToRoute('app.home');
    }
}
