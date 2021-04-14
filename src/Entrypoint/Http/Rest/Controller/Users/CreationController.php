<?php declare(strict_types=1);
namespace App\Entrypoint\Http\Rest\Controller\Users;

use App\Domain\Context\User\Creation\Handler as UserCreationHandler;
use App\Domain\Context\User\Creation\RequestModel;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

class CreationController
{
    private UserCreationHandler $userCreationHandler;

    public function __construct(UserCreationHandler $userCreationHandler)
    {
        $this->userCreationHandler = $userCreationHandler;
    }

    /**
     * @Route("/users", name="createUser", methods="POST")
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function createUserAction(Request $request): JsonResponse
    {
        try {
            $requestBody = json_decode($request->getContent(), true);

            $useCaseRequest = new RequestModel(
                $requestBody['name'] ?? '',
                $requestBody['email'] ?? '',
                $requestBody['password'] ?? ''
            );

            $userCreationResponse = $this->userCreationHandler->create($useCaseRequest);

            return new JsonResponse(
                [
                    'user' => [
                        'name' => $userCreationResponse->getUser()->getName(),
                        'email' => $userCreationResponse->getUser()->getEmail(),
                        'createdAt' => $userCreationResponse->getUser()->getCreatedAt(),
                        'updatedAt' => $userCreationResponse->getUser()->getUpdatedAt(),
                    ]
                ],
                JsonResponse::HTTP_CREATED
            );
        } catch (Throwable $throwable) {
            return new JsonResponse(['error' => $throwable->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}