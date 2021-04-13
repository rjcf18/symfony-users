<?php declare(strict_types=1);
namespace App\Tests\Unit\Domain\Context\User\Creation;

use App\Domain\Context\User\Creation\Exception\UserEmailCannotBeEmptyException;
use App\Domain\Context\User\Creation\Exception\UserNameCannotBeEmptyException;
use App\Domain\Context\User\Creation\Exception\UserPasswordCannotBeEmptyException;
use App\Domain\Context\User\Creation\Exception\UserWithEmailAlreadyExistsException;
use App\Domain\Context\User\Creation\RequestModel;
use App\Domain\Context\User\Creation\Service;
use App\Domain\Context\User\Creation\UserRepository;
use App\Domain\Context\User\Creation\Validator\Semantic as SemanticValidator;
use App\Domain\Shared\Entity\User;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ServiceTest extends TestCase
{
    private SemanticValidator|MockObject $semanticValidatorMock;

    private UserRepository|MockObject $userRepositoryMock;

    private Service $service;

    protected function setUp(): void
    {
        $this->semanticValidatorMock = $this->getSemanticValidatorMock();
        $this->userRepositoryMock = $this->getUserRepositoryMock();

        $this->service = new Service(
            $this->semanticValidatorMock,
            $this->userRepositoryMock,
        );
    }

    /**
     * @throws UserEmailCannotBeEmptyException
     * @throws UserNameCannotBeEmptyException
     * @throws UserPasswordCannotBeEmptyException
     * @throws UserWithEmailAlreadyExistsException
     */
    public function testCreateWhenAllIsValidReturnCreatedUser(): void
    {
        $requestModel = new RequestModel('Test', 'test@email.com', '12345');

        $this->semanticValidatorMock
            ->expects($this->once())
            ->method('validate')
            ->willReturn(true);

        $this->userRepositoryMock
            ->expects($this->once())
            ->method('findByEmail')
            ->with($requestModel->getEmail())
            ->willReturn(null);

        $createdUser = new User();
        $createdUser->setId(1);
        $createdUser->setName('Test');
        $createdUser->setEmail('test@email.com');
        $createdUser->setPassword('12345');

        $this->userRepositoryMock
            ->expects($this->once())
            ->method('create')
            ->willReturn($createdUser);

        $response = $this->service->create($requestModel);

        $this->assertEquals($createdUser, $response->getUser());
    }

    private function getSemanticValidatorMock(): SemanticValidator|MockObject
    {
        return $this->getMockBuilder(SemanticValidator::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['validate'])
            ->getMock();
    }

    private function getUserRepositoryMock(): UserRepository|MockObject
    {
        return $this->getMockBuilder(UserRepository::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['findByEmail', 'create'])
            ->getMock();
    }
}