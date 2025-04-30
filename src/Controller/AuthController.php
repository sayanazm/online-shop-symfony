<?php

namespace App\Controller;

use App\Dto\RegisterRequestDto;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AuthController extends AbstractController
{
    #[Route('/register', name: 'register', methods: ['POST'])]
    public function register(
        #[MapRequestPayload] RegisterRequestDto $request,
        EntityManagerInterface      $em,
        UserPasswordHasherInterface $passwordHasher,
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
            plainPassword: $request->password,
            name: $request->name,
            phone: $request->phone,
            hasher: $passwordHasher,
        );

        $em->persist($user);
        $em->flush();

        //TODO: отправлять приветственное смс на номер телефона

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