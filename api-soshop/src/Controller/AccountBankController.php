<?php

namespace App\Controller;

use App\Entity\AccountBank;
use App\Entity\User;
use App\Repository\AccountBankRepository;
use App\Repository\UserRepository;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountBankController extends AbstractController
{
    /* CREATE */
    #[Route('/accountBanks', name: 'api_post_account_bank', methods: ['POST'])]
    public function addOneAccountBank( Request $request, AccountBankRepository $accountBankRepository, SerializerInterface $serializer)
    {
        $data = $request->getContent();

        $accountBank = $serializer->deserialize($data, AccountBank::class,'json');
        $accountBankRepository->save($accountBank);

        return new Response('', Response::HTTP_CREATED);
    }

    /* READ */
    #[Route('/accountBanks/{id}', name: 'api_get_account_bank', methods: ['GET'])]
    public function getOneAccountBank(AccountBank $accountBank, SerializerInterface $serializer): Response
    {
        $data = $serializer->serialize($accountBank, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /* UPDATE */
    #[Route('/accountBank/{id}', name: 'api_update_account_bank', methods: ['PUT'])]
    public function updateOneAccountBank(Request $request, AccountBank $oldAccountBank, AccountBankRepository $accountBankRepository, SerializerInterface $serializer): Response
    {
        $data = $request->getContent();
        $newAccountBank = $serializer->deserialize($data, User::class,'json');
        $updateAccountBank = $accountBankRepository->update($newAccountBank, $oldAccountBank);
        $updateAccountBankSerialize = $serializer->serialize($updateAccountBank, 'json');

        $response = new Response($updateAccountBankSerialize);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }


    /* DELETE */
    #[Route('/accountBank/{id}', name: 'api_delete_account_bank', methods: ['DELETE'])]
    public function deleteOneAccountBank(AccountBank $accountBank, AccountBankRepository $accountBankRepository): Response
    {
        $accountBankRepository->remove($accountBank);
        return new Response('',Response::HTTP_OK);
    }
}
