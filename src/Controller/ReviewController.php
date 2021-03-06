<?php

namespace App\Controller;

use App\Entity\ArtType;
use App\Entity\ArtGenre;
use App\Entity\Comment;
use App\Entity\Work;
use App\Entity\Review;
use App\Form\CommentType;
use App\Form\ReviewType;
use App\Repository\ReviewRepository;
use Doctrine\ORM\EntityManagerInterface;
use http\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/review")
 */
class ReviewController extends AbstractController
{
    /**
     * @Route("/", name="review_index", methods={"GET"})
     * @param ReviewRepository $reviewRepository
     * @return Response
     */
    public function index(ReviewRepository $reviewRepository): Response
    {
        return $this->render('review/index.html.twig', [
            'reviews' => $reviewRepository->findAll(),
        ]);
    }
    
    /**
     * @Route("/new", name="review_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
         * @throws \Exception
     */
    public function new(Request $request): Response
    {
        $review = new Review();
        $form = $this->createForm(ReviewType::class, $review);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            
            $date = new \DateTime('now');
            $review->setPublishedDate($date);
            $entityManager->persist($review);
            $entityManager->flush();

            return $this->redirectToRoute('review_index');
        }

        return $this->render('review/new.html.twig', [
            'review' => $review,
            'form' => $form->createView(),
        ]);
    }
    
   
    
    
    /**
     * @Route("/{id}", name="review_show", methods={"GET"})
     * @param Review $review
     * @return Response
     */
    public function show(Review $review): Response
    {
       
        return $this->render('review/show.html.twig', [
            'review' => $review,
            
        ]);
    }
    

    
    /**
     * @Route("/{id}/edit", name="review_edit", methods={"GET","POST"})
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param Review $review
     * @return Response
     * @throws \Exception
     */
    public function edit(Request $request, EntityManagerInterface $em ,Review $review): Response
    {
        $form = $this->createForm(ReviewType::class, $review);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
    
            $date = new \DateTime('now');
            $review->setEditDate($date);
            $em->flush();
            return $this->redirectToRoute('review_index');
        }

        return $this->render('review/edit.html.twig', [
            'review' => $review,
            'form' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/{id}", name="review_delete", methods={"DELETE"})
     * @param Request $request
     * @param Review $review
     * @return Response
     */
    public function delete(Request $request, Review $review): Response
    {
        if ($this->isCsrfTokenValid('delete'.$review->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($review);
            $entityManager->flush();
        }
        
        return $this->redirectToRoute('review_index');
    }
    
    /**
     * @Route("/{id}/comment" , name="review_comment" , methods={"GET","POST"})
     * @param Request $request
     * @param Review $review
    
     * @return Response
     */
    
    public function addComment(Request $request, Review $review): Response
    {
        $comment = new Comment();
       
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();
            $comment->setReview($review);
            $entityManager->flush();
            $work = $review->getWork();
            return $this->redirectToRoute('work_show',['id'=>$work->getId()]);
        }
    
        return $this->render('review/comment.html.twig',[
            'review' => $review,
            'form' => $form->createView(),
        ]);
    }
}
