<?php declare(strict_types=1);
namespace App\Domain\Context\User\Listing;

interface Handler
{
    /**
     * @return ResponseModel
     */
    public function list(): ResponseModel;
}