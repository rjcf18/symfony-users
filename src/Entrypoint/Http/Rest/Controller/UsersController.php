<?php declare(strict_types=1);
namespace App\Entrypoint\Http\Rest\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class UsersController
{
    /**
     * @Route("/users", name="listUsers", methods="GET")
     */
    public function listUsersAction(): JsonResponse
    {
        return new JsonResponse(['data' => 'List Users'], JsonResponse::HTTP_OK);
    }

    /**
     * @Route("/users", name="createUser", methods="POST")
     */
    public function createUserAction(): JsonResponse
    {
        return new JsonResponse(['data' => 'Create User'], JsonResponse::HTTP_CREATED);
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