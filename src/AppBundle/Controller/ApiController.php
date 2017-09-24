<?php

namespace AppBundle\Controller;

use AppBundle\Model\Post;
use AppBundle\UseCase\PostsUseCase;
use AppBundle\UseCase\PublishPostUseCase;
use AppBundle\UseCase\Request\PostsRequest;
use AppBundle\UseCase\Request\PublishPostRequest;
use AppBundle\UseCase\Request\SinglePostRequest;
use AppBundle\UseCase\SinglePostUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ApiController
 * @package AppBundle\Controller
 * @Route("/api")
 */
class ApiController extends Controller
{
    /**
     * @return JsonResponse
     *
     * @Route("/posts", name="get_posts", methods={"GET"})
     */
    public function getPostsAction()
    {
        $useCase = $this->get(PostsUseCase::class);
        $response = $useCase->execute(new PostsRequest());
        return new JsonResponse($response->toArray());
    }

    /**
     * @param $id
     * @return JsonResponse
     *
     * @Route("/post/{id}", name="get_single_post", methods={"GET"}, requirements={"id": "\d+"})
     */
    public function getSinglePostAction($id)
    {
        $useCase = $this->get(SinglePostUseCase::class);
        $response = $useCase->execute(new SinglePostRequest($id));
        return new JsonResponse($response->toArray());
    }

    /**
     * @param Request $httpRequest
     * @return JsonResponse
     *
     * @Route("/post", name="post_post", methods={"POST"})
     */
    public function postPostAction(Request $httpRequest)
    {
        $poem = $this->get('serializer')->deserialize($httpRequest->getContent(), Post::class, "json");
        $useCase = $this->get(PublishPostUseCase::class);
        $response = $useCase->execute(new PublishPostRequest($poem));
        return new JsonResponse($response->toArray());
    }


}
