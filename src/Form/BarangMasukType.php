<?php

namespace App\Form;

use App\Entity\Barang;
use App\Entity\BarangMasuk;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class BarangMasukType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
          ->add('barang', EntityType::class, [
              'class' => Barang::class,
              'choice_label' => 'nama_barang',
              'attr' => ['class' => 'form-control select2 text-capitalize']
          ])
          ->add('spesifikasi')
          ->add('kondisi')
          ->add('jml_masuk')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BarangMasuk::class,
        ]);
    }
}
