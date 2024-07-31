<?php

namespace App\Form;

use App\Entity\Barang;
use App\Entity\BarangKeluar;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class BarangKeluarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('barang', EntityType::class, [
                'class' => Barang::class,
                'choice_label' => 'nama_barang',
                'attr' => ['class' => 'form-control select2 text-capitalize']
            ])
            ->add('jmlKeluar')
            ->add('deskripsi')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BarangKeluar::class,
        ]);
    }
}
