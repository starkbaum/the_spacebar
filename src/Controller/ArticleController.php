<?php


namespace App\Controller;


use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     * @return Response
     */
    public function homepage()
    {
        return $this->render('article/homepage.html.twig');
    }

    /**
     * @Route("/news/{slug}", name="article_show")
     * @param $slug
     * @param Environment $twigEnvironment
     * @return Response
     */
    public function show($slug, Environment $twigEnvironment): Response
    {
        $comments = [
            'First comment!',
            'Second comment!',
            'Third comment!',
        ];

        #return $this->render('article/show.html.twig', [
        #    'title' => ucwords(str_replace('-', ' ', $slug)),
        #    'slug' => $slug,
        #    'comments' => $comments,
        #]);

        $html =  $twigEnvironment->render('article/show.html.twig', [
            'title' => ucwords(str_replace('-', ' ', $slug)),
            'slug' => $slug,
            'comments' => $comments,
        ]);

        return new Response($html);
    }

    /**
     * @Route("/news/{slug}/heart", name="article_toggle_heart", methods={"POST"})
     * @param $slug
     * @param LoggerInterface $logger
     * @return JsonResponse
     */
    public function toggleArticleHeart($slug, LoggerInterface $logger): JsonResponse
    {
        // TODO - actually heart/unheart the article!
        $logger->info('Article is being hearted');

        return new JsonResponse(['hearts' => rand(5, 100)]);
    }
}