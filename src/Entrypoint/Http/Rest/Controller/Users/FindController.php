<?php declare(strict_types=1);
namespace App\Entrypoint\Http\Rest\Controller\Users;

use App\Domain\Context\User\Find\Handler as UserFindHandler;
use App\Domain\Context\User\Find\RequestModel;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

class FindController
{
    private UserFindHandler $userFindHandler;

    public function __construct(UserFindHandler $userFindHandler)
    {
        $this->userFindHandler = $userFindHandler;
    }

    /**
     * @Route("/users/{id}", name="fetchUser", methods="GET")
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function fetchUserAction(int $id): JsonResponse
    {
        try {
            $userFindRequest = new RequestModel($id);

            return new JsonResponse(
                [
                    'user' => UserArrayBuilder::build($this->userFindHandler->find($userFindRequest)->getUser()),
                ],
                JsonResponse::HTTP_CREATED
            );
        } catch (Throwable $throwable) {
            return new JsonResponse(['error' => $throwable->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}