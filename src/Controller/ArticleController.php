<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ArticleController extends AbstractController
{
    #[Route('/article', name: 'app_article')]
    public function index(
        ArticleRepository $articleRepository,
        PaginatorInterface $paginator,
        Request $request
    ): Response {

        $data = $articleRepository->findBy([], ['createdAt' => 'DESC']);

        $articles = $paginator->paginate(
            $data, 
            $request->query->getInt('page', 1), 
            5
        );

        return $this->render('article/index.html.twig', [
            'articles' => $articles
        ]);
    }
}