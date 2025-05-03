<?php

namespace App\User\Controller;

use App\User\Doctrine\Repository\UserRepository;
use App\User\Dto\RegisterRequestDto;
use App\User\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

class AuthController extends AbstractController
{
    #[Route('/register', name: 'register', methods: ['POST'])]
    public function register(
        #[MapRequestPayload] RegisterRequestDto $request,
        EntityManagerInterface      $em,
        UserRepository              $userRepository,
    ): Response|JsonResponse {
        if (
            $userRepository->findOneBy(['email' => $request->email])
            || $userRepository->findOneBy(['phone' => $request->phone])
        ) {
            return new JsonResponse([
                'status' => 'error',
                'message' => 'User is already registered',
            ], Response::HTTP_CONFLICT);
        }

        $user = new User(
            email: $request->email,
            password: $request->password,
            name: $request->name,
            phone: $request->phone,
        );

        $em->persist($user);
        $em->flush();

        return new JsonResponse([
            'message' => 'Registered successfully',
        ]);
    }

    #[Route('/api/me', name: 'api_me', methods: ['GET'])]
    public function me(Security $security): JsonResponse
    {
        $user = $security->getUser();

        return $this->json([
            'email' => $user->getUserIdentifier(),
            'name'  => $user->getName(),
        ]);
    }
}