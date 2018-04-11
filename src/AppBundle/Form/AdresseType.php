<?php

namespace AppBundle\Form;

use AppBundle\Entity\Adresse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdresseType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('type', ChoiceType::class, ['label' => 'Type', 'choices' => ['Principale' => Adresse::TYPE_PRINCIPALE, 'Secondaire' => Adresse::TYPE_SECONDAIRE]])
            ->add('civilite')
            ->add('nom')
            ->add('prenom')
            ->add('raison_sociale')
            ->add('adresse_ligne_1', TextType::class, ['label' => 'rue ligne 1'])
            ->add('adresse_ligne_2', TextType::class, ['label' => 'rue ligne 2', 'required' => false])
            ->add('ville');
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Adresse'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_adresse';
    }


}
