<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ContactFormType extends AbstractType
{

    public function yearsArray(){
        $now = (int)date("Y");
        $a = array();

        for ($i = 1900; $i < $now; $i++) {
            array_push($a, $i);
        }
        return $a;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',                   TextType::class)
            ->add('from',           EmailType::class, ['label' => 'Email'])
            ->add('dateOfBirth',    DateType::class,       ['years' => $this->yearsArray() ])
            ->add('message',        TextareaType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
