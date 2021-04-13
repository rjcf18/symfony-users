<?php declare(strict_types=1);
namespace App\Tests\Unit\Domain\Context\User\Creation\Validator;

use App\Domain\Context\User\Creation\Exception\UserEmailCannotBeEmptyException;
use App\Domain\Context\User\Creation\Exception\UserNameCannotBeEmptyException;
use App\Domain\Context\User\Creation\Exception\UserPasswordCannotBeEmptyException;
use App\Domain\Context\User\Creation\Exception\UserWithEmailAlreadyExistsException;
use App\Domain\Context\User\Creation\RequestModel;
use App\Domain\Context\User\Creation\Validator\Semantic as SemanticValidator;
use App\Domain\Shared\Entity\User;
use PHPUnit\Framework\TestCase;

class SemanticTest extends TestCase
{
    private SemanticValidator $semanticValidator;

    protected function setUp(): void
    {
        $this->semanticValidator = new SemanticValidator();
    }

    /**
     * @throws UserNameCannotBeEmptyException
     * @throws UserEmailCannotBeEmptyException
     * @throws UserPasswordCannotBeEmptyException
     * @throws UserWithEmailAlreadyExistsException
     */
    public function testValidateWhenUserNameIsEmptyThrowsException(): void
    {
        $expectedException = new UserNameCannotBeEmptyException();

        $this->expectException(UserNameCannotBeEmptyException::class);
        $this->expectExceptionMessage($expectedException->getMessage());

        $this->semanticValidator->validate(new RequestModel('', '', ''), null);
    }

    /**
     * @throws UserNameCannotBeEmptyException
     * @throws UserEmailCannotBeEmptyException
     * @throws UserPasswordCannotBeEmptyException
     * @throws UserWithEmailAlreadyExistsException
     */
    public function testValidateWhenUserEmailIsEmptyThrowsException(): void
    {
        $expectedException = new UserEmailCannotBeEmptyException();

        $this->expectException(UserEmailCannotBeEmptyException::class);
        $this->expectExceptionMessage($expectedException->getMessage());

        $this->semanticValidator->validate(new RequestModel('Test', '', ''), null);
    }

    /**
     * @throws UserNameCannotBeEmptyException
     * @throws UserEmailCannotBeEmptyException
     * @throws UserPasswordCannotBeEmptyException
     * @throws UserWithEmailAlreadyExistsException
     */
    public function testValidateWhenUserPasswordIsEmptyThrowsException(): void
    {
        $expectedException = new UserPasswordCannotBeEmptyException();

        $this->expectException(UserPasswordCannotBeEmptyException::class);
        $this->expectExceptionMessage($expectedException->getMessage());

        $this->semanticValidator->validate(
            new RequestModel('Test', 'test@email.com', ''),
            null
        );
    }

    /**
     * @throws UserNameCannotBeEmptyException
     * @throws UserEmailCannotBeEmptyException
     * @throws UserPasswordCannotBeEmptyException
     * @throws UserWithEmailAlreadyExistsException
     */
    public function testValidateWhenUserAlreadyExistsThrowsException(): void
    {
        $expectedException = new UserWithEmailAlreadyExistsException();

        $this->expectException(UserWithEmailAlreadyExistsException::class);
        $this->expectExceptionMessage($expectedException->getMessage());

        $this->semanticValidator->validate(
            new RequestModel('Test', 'test@email.com', '12345'),
            new User()
        );
    }

    /**
     * @throws UserNameCannotBeEmptyException
     * @throws UserEmailCannotBeEmptyException
     * @throws UserPasswordCannotBeEmptyException
     * @throws UserWithEmailAlreadyExistsException
     */
    public function testValidateWhenAllIsValidReturnTrue(): void
    {
        $this->assertTrue(
            $this->semanticValidator->validate(
                new RequestModel('Test', 'test@email.com', '12345'),
                null
            )
        );
    }
}