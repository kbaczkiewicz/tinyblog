<?php

namespace AppBundle\Controller;

use AppBundle\Model\Poem;
use AppBundle\UseCase\PoemsUseCase;
use AppBundle\UseCase\PublishPoemUseCase;
use AppBundle\UseCase\Request\PoemsRequest;
use AppBundle\UseCase\Request\PublishPoemRequest;
use AppBundle\UseCase\Request\SinglePoemRequest;
use AppBundle\UseCase\SinglePoemUseCase;
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
     * @Route("/poems", name="get_poems", methods={"GET"})
     */
    public function getPoemsAction()
    {
        $useCase = $this->get(PoemsUseCase::class);
        $response = $useCase->execute(new PoemsRequest());
        return new JsonResponse($response->toArray());
    }

    /**
     * @param $id
     * @return JsonResponse
     *
     * @Route("/poem/{id}", name="get_single_poem", methods={"GET"}, requirements={"id": "\d+"})
     */
    public function getSinglePoemAction($id)
    {
        $useCase = $this->get(SinglePoemUseCase::class);
        $response = $useCase->execute(new SinglePoemRequest($id));
        return new JsonResponse($response->toArray());
    }

    /**
     * @param Request $httpRequest
     * @return JsonResponse
     *
     * @Route("/poem", name="post_poem", methods={"POST"})
     */
    public function postPoemAction(Request $httpRequest)
    {
        $poem = $this->get('serializer')->deserialize($httpRequest->getContent(), Poem::class, "json");
        $useCase = $this->get(PublishPoemUseCase::class);
        $response = $useCase->execute(new PublishPoemRequest($poem));
        return new JsonResponse($response->toArray());
    }
}
