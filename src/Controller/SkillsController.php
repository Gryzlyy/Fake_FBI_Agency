<?php

namespace App\Controller;

use App\Entity\Skills;
use App\Form\AddSkillType;
use App\Repository\ContactsRepository;
use App\Repository\SkillsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SkillsController extends AbstractController
{
    #[Route('/skills', name: 'skills_index')]
    public function index(SkillsRepository $skillsRepository): Response
    {
        return $this->render('skills/index.html.twig', [
            'skills' => $skillsRepository->findAll(),
        ]);
    }

    /**
     * @Route ("/skills/{id}", name="skill_details")
     */
    public function showSkill(int $id, SkillsRepository $skillsRepository): Response
    {
        return $this->render('skills/showSkill.html.twig', [
            'skill' => $skillsRepository->find($id),
        ]);
    }

    /**
     * @Route ("/skills-add", name="skill_add")
     */
    public function addSkill(Request $request): Response
    {
        $skill = new Skills();
        $form = $this->createForm(AddSkillType::class, $skill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($skill);
            $entityManager->flush();

            return $this->redirectToRoute('skills_index');
        }

        return $this->render('skills/addSkill.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route ("/skills/{id}/update", name="skill_update", methods={"GET", "POST"})
     */
    public function updateContact(Request $request, Skills $skill): Response
    {
        $form = $this->createForm(AddSkillType::class, $skill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('skills_index');
        }

        return $this->render('skills/editSkill.html.twig', [
            'skill' => $skill,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route ("/skills/{id}/delete", name="skill_delete", methods={"GET"})
     */
    public function deleteContact(int $id, SkillsRepository $skillsRepository): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $skill = $skillsRepository->find($id);
        if (!$skill) {
            return $this->redirectToRoute('skills_index');
        }

        $entityManager->remove($skill);
        $entityManager->flush();

        return $this->redirectToRoute('skills_index');
    }
}
