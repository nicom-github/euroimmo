<?php

namespace App\Controller\Admin;

use App\Entity\Address;
use App\Entity\Agency;
use App\Entity\Bank;
use App\Entity\Country;
use App\Entity\Img;
use App\Entity\RealEstate;
use App\Entity\StatusRealEstate;
use App\Entity\TypeRealEstate;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;


class DashboardController extends AbstractDashboardController
{
    /**
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     */
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $routeBuilder = $this->container->get(AdminUrlGenerator::class);
        $url = $routeBuilder->setController(UserCrudController::class)->generateUrl();

        return $this->redirect($url);

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Euroimmo');
    }

    public function configureMenuItems(): iterable
    {

        yield MenuItem::linktoRoute('Back to the website', 'fas fa-home', 'home/index.html.twig');

        yield MenuItem::linkToCrud('User', 'fas fa-map-marker-alt', User::class);
        yield MenuItem::linkToCrud('Agency', 'fas fa-map-marker-alt', Agency::class);
        yield MenuItem::linkToCrud('Bank', 'fas fa-map-marker-alt', Bank::class);
        yield MenuItem::linkToCrud('RealEstate', 'fas fa-map-marker-alt', RealEstate::class);
        yield MenuItem::linkToCrud('StatusRealEstate', 'fas fa-map-marker-alt', StatusRealEstate::class);
        yield MenuItem::linkToCrud('TypeRealEstate', 'fas fa-map-marker-alt', TypeRealEstate::class);
        yield MenuItem::linkToCrud('Country', 'fas fa-map-marker-alt', Country::class);
        yield MenuItem::linkToCrud('Address', 'fas fa-map-marker-alt', Address::class);
        yield MenuItem::linkToCrud('Img', 'fas fa-map-marker-alt', Img::class);
    }



}
