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
     * @Route("/users", name="updateUser", methods="PUT")
     */
    public function updateUserAction(): JsonResponse
    {
        return new JsonResponse(['data' => 'Update User'], JsonResponse::HTTP_OK);
    }

    /**
     * @Route("/users", name="deleteUser", methods="DELETE")
     */
    public function deleteUserAction(): JsonResponse
    {
        return new JsonResponse(['data' => 'Delete User'], JsonResponse::HTTP_OK);
    }
}