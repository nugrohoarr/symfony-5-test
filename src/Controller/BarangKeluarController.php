<?php

namespace App\Controller;

use App\Entity\BarangKeluar;
use App\Form\BarangKeluarType;
use App\Repository\BarangKeluarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/barang_keluar')]
class BarangKeluarController extends AbstractController
{
    #[Route('/', name: 'app_barang_keluar_index', methods: ['GET'])]
    public function index(BarangKeluarRepository $barangKeluarRepository): Response
    {
        return $this->render('barang_keluar/index.html.twig', [
            'barang_keluars' => $barangKeluarRepository->findAllWithBarang(),
        ]);
    }

    #[Route('/new', name: 'app_barang_keluar_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BarangKeluarRepository $barangKeluarRepository): Response
    {
        $barangKeluar = new BarangKeluar();
        // Set default date
        $barangKeluar->setTglKeluar(new \DateTime());

        $form = $this->createForm(BarangKeluarType::class, $barangKeluar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $barangKeluarRepository->add($barangKeluar, true);

            return $this->redirectToRoute('app_barang_keluar_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('barang_keluar/new.html.twig', [
            'barang_keluar' => $barangKeluar,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_barang_keluar_show', methods: ['GET'])]
    public function show(BarangKeluar $barangKeluar): Response
    {
        return $this->render('barang_keluar/show.html.twig', [
            'barang_keluar' => $barangKeluar,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_barang_keluar_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, BarangKeluar $barangKeluar, BarangKeluarRepository $barangKeluarRepository): Response
    {
        $form = $this->createForm(BarangKeluarType::class, $barangKeluar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $barangKeluarRepository->add($barangKeluar, true);

            return $this->redirectToRoute('app_barang_keluar_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('barang_keluar/edit.html.twig', [
            'barang_keluar' => $barangKeluar,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_barang_keluar_delete', methods: ['POST'])]
    public function delete(Request $request, BarangKeluar $barangKeluar, BarangKeluarRepository $barangKeluarRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$barangKeluar->getId(), $request->request->get('_token'))) {
            $barangKeluarRepository->remove($barangKeluar, true);
        }

        return $this->redirectToRoute('app_barang_keluar_index', [], Response::HTTP_SEE_OTHER);
    }
}
