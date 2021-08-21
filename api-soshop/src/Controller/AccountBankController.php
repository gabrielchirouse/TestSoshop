<?php

namespace App\Controller;

use App\Entity\AccountBank;
use App\Entity\User;
use App\Repository\AccountBankRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use JetBrains\PhpStorm\Pure;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountBankController extends AbstractController
{
    /* CREATE */
    #[Route('/users/{id}/accountBanks', name: 'api_post_account_bank', methods: ['POST'])]
    public function addOneAccountBank( Request $request,User $user, AccountBankRepository $accountBankRepository, SerializerInterface $serializer)
    {
        $data = $request->getContent();

        /** @var AccountBank $accountBank */
        $accountBank = $serializer->deserialize($data, AccountBank::class,'json');
        $accountBank->setUser($user);
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
    #[Route('/accountBanks/{id}', name: 'api_update_account_bank', methods: ['PUT'])]
    public function updateOneAccountBank(Request $request, AccountBank $oldAccountBank, AccountBankRepository $accountBankRepository, SerializerInterface $serializer): Response
    {

        try {
            $data = $request->getContent();
            $newAccountBank = $serializer->deserialize($data, AccountBank::class,'json');
            $updateAccountBank = $accountBankRepository->update($newAccountBank, $oldAccountBank);
            $updateAccountBankSerialize = $serializer->serialize($updateAccountBank, 'json');
            $response = new Response($updateAccountBankSerialize);
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        } catch (ORMException | \Exception $e) {
            return new Response($e->getMessage(), $e->getCode());
        }
    }


    /* DELETE */
    #[Route('/accountBanks/{id}', name: 'api_delete_account_bank', methods: ['DELETE'])]
    public function deleteOneAccountBank(AccountBank $accountBank, AccountBankRepository $accountBankRepository): Response
    {
        $accountBankRepository->remove($accountBank);
        return new Response('',Response::HTTP_OK);
    }

    /* CSV */
    #[Route('/accountBanks/{id}/csv', name: 'api_csv_account_bank', methods: ['GET'])]
    public function CSVOneAccountBank(AccountBank $accountBank): Response
    {
        try {
            $fsObject = new Filesystem();
            $workingDir = getcwd();
            $filePath = '/csv/file'.uniqid().'.csv';
            $new_file_path = $workingDir.$filePath;

            $fsObject->touch($new_file_path);
            $fsObject->chmod($new_file_path, 0777);
            $fsObject->dumpFile($new_file_path,'id;name;surname;birthday;iban;balance;cardNumber;cardStatus;cardExpiryDate'."\n");
            $fsObject->appendToFile($new_file_path, $accountBank->getUser()->getId().";");

            $nameAnonymize = str_repeat("*", strlen($accountBank->getUser()->getName()));
            $fsObject->appendToFile($new_file_path, $nameAnonymize.";");

            $surnameAnonymize = str_repeat("*", strlen($accountBank->getUser()->getSurname()));
            $fsObject->appendToFile($new_file_path, $surnameAnonymize.";");

            $fsObject->appendToFile($new_file_path, $accountBank->getUser()->getBirthday()->format('d/m/Y').";");

            $ibanAnonymize = '****'.substr($accountBank->getIban(),4,strlen($accountBank->getIban())-7).'***';
            $fsObject->appendToFile($new_file_path, $ibanAnonymize.";");

            $fsObject->appendToFile($new_file_path, $accountBank->getBalance().";");

            $cardBankNumberAnonymize = str_repeat("*", strlen($accountBank->getCardBank()->getNumber()));
            $fsObject->appendToFile($new_file_path, $cardBankNumberAnonymize.";");

            $fsObject->appendToFile($new_file_path, $accountBank->getCardBank()->getStatus().";");
            $fsObject->appendToFile($new_file_path, $accountBank->getCardBank()->getExpiryDate()->format('d/m/Y'));
            return $this->redirect($filePath);
        }catch (IOExceptionInterface $exception){
            return new Response($exception->getMessage(), Response::HTTP_NOT_ACCEPTABLE);
        }
    }
}
