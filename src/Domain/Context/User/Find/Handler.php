<?php declare(strict_types=1);
namespace App\Domain\Context\User\Find;

interface Handler
{
    public function find(RequestModel $useCaseRequest): ResponseModel;
}