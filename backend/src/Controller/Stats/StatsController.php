<?php

namespace App\Controller\Stats;

use App\Entity\Comment;
use App\Entity\Game;
use App\Entity\News;
use App\Entity\Review;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StatsController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $em) {}

    #[Route('/stats', name: 'app_stats')]
    public function index(): Response
    {
        $stats = [
            'games'    => $this->em->getRepository(Game::class)->count([]),
            'news'     => $this->em->getRepository(News::class)->count([]),
            'reviews'  => $this->em->getRepository(Review::class)->count([]),
            'users'    => $this->em->getRepository(User::class)->count([]),
            'comments' => $this->em->getRepository(Comment::class)->count([]),
        ];

        return $this->render('stats/stats.html.twig', ['stats' => $stats]);
    }
}
