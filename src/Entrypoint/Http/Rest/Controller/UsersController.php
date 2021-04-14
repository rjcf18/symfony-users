<?php declare(strict_types=1);
namespace App\Entrypoint\Http\Rest\Controller;

use App\Domain\Context\User\Creation\Handler as UserCreationHandler;
use App\Domain\Context\User\Creation\RequestModel;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

class UsersController
{
    private UserCreationHandler $userCreationHandler;

    public function __construct(UserCreationHandler $userCreationHandler)
    {
        $this->userCreationHandler = $userCreationHandler;
    }

    /**
     * @Route("/users", name="listUsers", methods="GET")
     */
    public function listUsersAction(): JsonResponse
    {
        return new JsonResponse(['data' => 'List Users'], JsonResponse::HTTP_OK);
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

    /**
     * @Route("/users/{id}", name="fetchUser", methods="GET")
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function fetchUserAction(int $id): JsonResponse
    {
        return new JsonResponse(['data' => 'Fetch User', 'id' => $id], JsonResponse::HTTP_CREATED);
    }

    /**
     * @Route("/users/{id}", name="updateUser", methods="PUT")
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function updateUserAction(int $id): JsonResponse
    {
        return new JsonResponse(['data' => 'Update User', 'id' => $id], JsonResponse::HTTP_OK);
    }

    /**
     * @Route("/users/{id}", name="deleteUser", methods="DELETE")
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function deleteUserAction(int $id): JsonResponse
    {
        return new JsonResponse(['data' => 'Delete User', 'id' => $id], JsonResponse::HTTP_OK);
    }
}