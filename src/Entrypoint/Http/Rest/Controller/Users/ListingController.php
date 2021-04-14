<?php declare(strict_types=1);
namespace App\Entrypoint\Http\Rest\Controller\Users;

use App\Domain\Context\User\Listing\Handler as UserListingHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ListingController
{
    private UserListingHandler $userListingHandler;

    public function __construct(UserListingHandler $userListingHandler)
    {
        $this->userListingHandler = $userListingHandler;
    }

    /**
     * @Route("/users", name="listUsers", methods="GET")
     */
    public function listUsersAction(): JsonResponse
    {
        return new JsonResponse(
            [
                'users' => UsersArrayBuilder::build($this->userListingHandler->list()->getUserCollection())
            ],
            JsonResponse::HTTP_OK
        );
    }
}