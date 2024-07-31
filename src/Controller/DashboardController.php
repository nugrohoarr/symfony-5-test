<?php
// src/Controller/DashboardController.php
namespace App\Controller;

use App\Repository\BarangRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/')]
class DashboardController extends AbstractController
{
    #[Route('/', name: 'dashboard', methods: ['GET'])]
    public function dashboard(BarangRepository $barangRepository, UserRepository $userRepository): Response
    {
        $stoks = $barangRepository->findDashboardData();
        $totalBarang = $barangRepository->countAllBarang();
        $totalUsers = $userRepository->countAllUsers();

        return $this->render('dashboard/index.html.twig', [
            'stoks' => $stoks,
            'totalBarang' => $totalBarang,
            'totalUsers' => $totalUsers,
        ]);
    }
}
