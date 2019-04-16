<?php

namespace App\Controller;

use App\Entity\Fitness;
use App\Repository\FitnessRepository;
use App\Form\FitnessType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("profile")
 */
class FitnessController extends AbstractController
{

    const PAGE_TYPE = 'addMeasurement';

    /**
     * @Route("/fitness", name="fitness_index")
     */
    public function index(FitnessRepository $fitnessRepository): Response
    {
        /* @var $fitnessMeasurements \App\Repository\FitnessRepository */
        $fitnessMeasurements = $fitnessRepository->findBy(['user' => $this->getUser()], ['createdAt' => 'DESC']);

        return $this->render('fitness/index.html.twig', [
                'page' => self::PAGE_TYPE,
                'fitness_measurements' => $fitnessMeasurements,
        ]);
    }

    /**
     * @Route(
     *   "/fitness-new",
     *   name="fitness_new",
     *   methods="GET|POST"
     * )
     */
    public function new(Request $request): Response
    {
        $fitness = (new Fitness())
            ->setUser($this->getUser());
        $form = $this->createForm(FitnessType::class, $fitness);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($fitness);
            $em->flush();

            $this->addFlash(
                'notice',
                'Twoje wymiary zostały zapisane!'
            );

            return $this->redirectToRoute('fitness_index');
        }

        return $this->render('fitness/new.html.twig', [
                'fitness' => $fitness,
                'form' => $form->createView(),
                'page' => self::PAGE_TYPE,
        ]);
    }

    /**
     * @Route(
     *   "/{id}/show",
     *   name="fitness_show",
     *   methods="GET"
     * )
     */
    public function show(Fitness $fitness): Response
    {
        $this->denyAccessUnlessGranted('show_fitness', $fitness);

        return $this->render('fitness/show.html.twig', [
                'fitness' => $fitness,
                'page' => self::PAGE_TYPE,
        ]);
    }

    /**
     * @Route(
     *   "/{id}/edit",
     *   name="fitness_edit",
     *   requirements={"id"="\d+"},
     *   methods="GET|POST"
     * )
     */
    public function edit(Request $request, Fitness $fitness): Response
    {
        $this->denyAccessUnlessGranted('edit_fitness', $fitness);

        $form = $this->createForm(FitnessType::class, $fitness);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'notice',
                'Zmiany zostały zapisane!'
            );
            return $this->redirectToRoute('fitness_index');
        }

        return $this->render('fitness/edit.html.twig', [
                'fitness' => $fitness,
                'form' => $form->createView(),
                'page' => self::PAGE_TYPE,
        ]);
    }

    /**
     * @Route(
     *   "/{id}",
     *   name="fitness_delete",
     *   requirements={"id"="\d+"},
     *   methods="DELETE"
     * )
     */
    public function delete(Request $request, Fitness $fitness): Response
    {
        if ($this->isCsrfTokenValid('delete' . $fitness->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($fitness);
            $em->flush();
        }

        return $this->redirectToRoute('fitness_index');
    }

}
