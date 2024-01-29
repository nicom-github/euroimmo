<?php

namespace App\Controller;

use App\Entity\RealEstate;
use App\Repository\AddressRepository;
use App\Repository\AgencyRepository;
use App\Repository\ImgRepository;
use App\Repository\RealEstateRepository;
use App\Repository\StatusRealEstateRepository;
use App\Repository\TypeRealEstateRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class ListRealEstateController extends AbstractController
{
    #[Route('/list', name: 'app_list')]
    public function list(RealEstateRepository $realEstateRepository): Response
    {
        $realEstates = $realEstateRepository->findAll();

        return $this->render('list/list.html.twig', [
            'controller_name' => 'ListRealEstateController',
            "realEstates" => $realEstates
        ]);
    }

    #[Route("/realEstate{id}", name:"realEstate")]
    public function show(
        int $id,
        RealEstateRepository $realEstateRepository
    ): Response
    {
        $realEstate = $realEstateRepository->find($id);
        return $this->render('list/show.html.twig',[
            "realEstate"=>$realEstate
        ]);
    }
}
