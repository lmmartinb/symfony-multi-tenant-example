<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\TestRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/test', name: 'test', methods: ['GET'])]
class TestController extends AbstractController
{
    public function __construct(
        private readonly TestRepository $repository,
    ) {
    }

    public function __invoke(): JsonResponse
    {
        $data = $this->repository->findAll();

        return new JsonResponse($data, Response::HTTP_OK);
    }

}