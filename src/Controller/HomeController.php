<?php
    
    
    namespace App\Controller;

    use App\Repository\ArtGenreRepository;
    use App\Repository\ReviewRepository;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;

    class HomeController extends AbstractController
    {
        /**
         * @Route("/", name="home")
         * @param ReviewRepository $reviewRepository
         * @param ArtGenreRepository $artGenreRepository
         * @return Response
         */
        public function index(ReviewRepository $reviewRepository, ArtGenreRepository $artGenreRepository): Response
        {
           $lastReviews = $reviewRepository->findBy([],['editDate' => 'DESC'], '3');
           $bestReviews = $reviewRepository->findBy([],['rating' => 'DESC'], '5');
            $artGenres = $artGenreRepository->findall();
            return $this->render('home/index.html.twig', [
                'lastReviews'=> $lastReviews,
                'bestReviews'=> $bestReviews,
               'artGenres'=> $artGenres
            ]);
        }
    }
