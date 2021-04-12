<?php declare(strict_types=1);
namespace App\Entrypoint\Http\Rest\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class IndexController
{
    /**
     * @Route("/", name="helloWorld", methods="GET")
     */
    public function helloWorldAction(): JsonResponse
    {
        return new JsonResponse(['data' => 'Hello World'], JsonResponse::HTTP_OK);
    }
}