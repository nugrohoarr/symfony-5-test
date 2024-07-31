<?php

namespace App\Controller;

use App\Entity\BarangMasuk;
use App\Form\BarangMasukType;
use App\Repository\BarangMasukRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/barang_masuk')]
class BarangMasukController extends AbstractController
{
    #[Route('/', name: 'app_barang_masuk_index', methods: ['GET'])]
    public function index(BarangMasukRepository $barangMasukRepository): Response
    {
        return $this->render('barang_masuk/index.html.twig', [
            'barang_masuks' => $barangMasukRepository->findAllWithBarang(),
        ]);
    }

    #[Route('/new', name: 'app_barang_masuk_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BarangMasukRepository $barangMasukRepository): Response
    {
        $barangMasuk = new BarangMasuk();
        // Set default date
        $barangMasuk->setTglMasuk(new \DateTime());

        $form = $this->createForm(BarangMasukType::class, $barangMasuk);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $barangMasukRepository->add($barangMasuk, true);

            return $this->redirectToRoute('app_barang_masuk_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('barang_masuk/new.html.twig', [
            'barang_masuk' => $barangMasuk,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_barang_masuk_show', methods: ['GET'])]
    public function show(BarangMasuk $barangMasuk): Response
    {
        return $this->render('barang_masuk/show.html.twig', [
            'barang_masuk' => $barangMasuk,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_barang_masuk_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, BarangMasuk $barangMasuk, BarangMasukRepository $barangMasukRepository): Response
    {
        $form = $this->createForm(BarangMasukType::class, $barangMasuk);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $barangMasukRepository->add($barangMasuk, true);

            return $this->redirectToRoute('app_barang_masuk_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('barang_masuk/edit.html.twig', [
            'barang_masuk' => $barangMasuk,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_barang_masuk_delete', methods: ['POST'])]
    public function delete(Request $request, BarangMasuk $barangMasuk, BarangMasukRepository $barangMasukRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$barangMasuk->getId(), $request->request->get('_token'))) {
            $barangMasukRepository->remove($barangMasuk, true);
        }

        return $this->redirectToRoute('app_barang_masuk_index', [], Response::HTTP_SEE_OTHER);
    }
}
