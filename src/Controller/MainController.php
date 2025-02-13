<?php

namespace App\Controller;

use App\Repository\PlanetRepository;
use App\Repository\VoyageRepository;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;
use Survos\PwaExtraBundle\Attribute\PwaExtra;
use Survos\PwaExtraBundle\Service\PwaService;
use Symfony\Bridge\Twig\Attribute\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function homepage(
        VoyageRepository $voyageRepository,
        PlanetRepository $planetRepository,
        #[MapQueryParameter] int $page = 1,
        #[MapQueryParameter] string $sort = 'leaveAt',
        #[MapQueryParameter] string $sortDirection = 'ASC',
        #[MapQueryParameter] ?string $query = null,
        #[MapQueryParameter('planets', \FILTER_VALIDATE_INT)] array $searchPlanets = [],
    ): Response
    {
        $validSorts = ['purpose', 'leaveAt'];
        $sort = in_array($sort, $validSorts) ? $sort : 'leaveAt';
        $pager = Pagerfanta::createForCurrentPageWithMaxPerPage(
            new QueryAdapter($voyageRepository->findBySearchQueryBuilder($query, $searchPlanets, $sort, $sortDirection)),
            $page,
            10
        );

        return $this->render('main/homepage.html.twig', [
            'voyages' => $pager,
            'planets' => $planetRepository->findAll(),
            'searchPlanets' => $searchPlanets,
            'sort' => $sort,
            'sortDirection' => $sortDirection,
        ]);
    }

    #[Route('/swiper', name: 'app_swiper')]
    #[Template('main/swiper.html.twig')]
    #[PwaExtra(cacheStrategy: PwaService::CacheFirst)]
    public function swiper(PlanetRepository $planetRepository): array
    {
        return ['planets' => $planetRepository->findAll()];
    }


    #[Route('/onsen', name: 'app_onsen')]
    #[Template('main/onsen.html.twig')]
    #[PwaExtra(cacheStrategy: PwaService::CacheFirst)]
    public function onsen(PlanetRepository $planetRepository): array
    {
        return ['planets' => $planetRepository->findAll()];
    }


    #[Route('/about', name: 'app_about')]
    #[Template('main/about.html.twig')]
    #[PwaExtra(cacheStrategy: PwaService::CacheFirst)]
    public function about(?PwaService $pwaService=null): array
    {
        return [
            'cacheInfo' => $pwaService?->getCacheInfo()
        ];
    }

    #[Route('/offline', name: 'app_offline_page')]
    #[Template('main/offline.html.twig')]
    public function offline(): array
    {
        return [
        ];
    }

}
