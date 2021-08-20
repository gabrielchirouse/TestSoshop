<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /* CREATE */
    #[Route('/users', name: 'api_post_user', methods: ['POST'])]
    public function addUser( Request $request, UserRepository $userRepository, SerializerInterface $serializer)
    {
        $data = $request->getContent();

        $user = $serializer->deserialize($data, User::class,'json');
        $userRepository->save($user);

        return new Response('', Response::HTTP_CREATED);
    }

    /* READ */
    #[Route('/users/{id}', name: 'api_get_user', methods: ['GET'])]
    public function getOneUser(User $user, SerializerInterface $serializer): Response
    {
        $data = $serializer->serialize($user, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /* UPDATE */
    #[Route('/users/{id}', name: 'api_update_user', methods: ['PUT'])]
    public function updateOneUser(Request $request, User $oldUser, UserRepository $userRepository, SerializerInterface $serializer): Response
    {
        $data = $request->getContent();
        $newUser = $serializer->deserialize($data, User::class,'json');
        $updateUser = $userRepository->update($newUser, $oldUser);
        $updateUserSerialize = $serializer->serialize($updateUser, 'json');

        $response = new Response($updateUserSerialize);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }


    /* DELETE */
    #[Route('/users/{id}', name: 'api_delete_user', methods: ['DELETE'])]
    public function deleteOneUser(User $user, UserRepository $userRepository): Response
    {
        $userRepository->remove($user);
        return new Response('',Response::HTTP_OK);
    }
}
