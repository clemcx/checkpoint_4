<?php

namespace App\Controller;

use App\Entity\Review;

use App\Entity\Work;
use App\Entity\Comment;
use App\Form\CommentType;
use App\Form\WorkType;
use App\Repository\WorkRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/work")
 */
class WorkController extends AbstractController
{
    /**
     * @Route("/", name="work_index", methods={"GET"})
     * @param WorkRepository $workRepository
     * @return Response
     */
    public function index(WorkRepository $workRepository): Response
    {
        return $this->render('work/index.html.twig', [
            'works' => $workRepository->findAll(),
        ]);
    }
    
    /**
     * @Route("/new", name="work_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $work = new Work();
        $form = $this->createForm(WorkType::class, $work);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($work);
            $entityManager->flush();

            return $this->redirectToRoute('work_index');
        }

        return $this->render('work/new.html.twig', [
            'work' => $work,
            'form' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/{id}", name="work_show", methods={"GET","POST"})
     * @param Request $request
     * @param Work $work
     * @return Response,
     */
    public function show(Request $request, Work $work): Response
    {
        
        return $this->render('work/show.html.twig', [
            'work' => $work,
            
        ]);
    }
    
    /**
     * @Route("/{id}/edit", name="work_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Work $work
     * @return Response
     */
    public function edit(Request $request, Work $work): Response
    {
        $form = $this->createForm(WorkType::class, $work);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('work_index');
        }

        return $this->render('work/edit.html.twig', [
            'work' => $work,
            'form' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/{id}", name="work_delete", methods={"DELETE"})
     * @param Request $request
     * @param Work $work
     * @return Response
     */
    public function delete(Request $request, Work $work): Response
    {
        if ($this->isCsrfTokenValid('delete'.$work->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($work);
            $entityManager->flush();
        }

        return $this->redirectToRoute('work_index');
    }
}
