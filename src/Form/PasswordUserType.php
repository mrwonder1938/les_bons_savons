<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormError;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Constraints\Length;

class PasswordUserType extends AbstractType // Correction du mot-clé 'Type' à 'extends'
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('actualPassword', PasswordType::class, [
                'mapped' => false,
                'label' => 'Ton mot de passe actuel',
                'attr' => [
                    'placeholder' => "Indique ton mot de passe"
                ],
                'mapped' => false,
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'constraints' => [
                    new Length([
                        'min' => 8,
                        'max' => 30
                    ])
                ],
                'first_options' => [
                    'label' => 'Ton nouveau mot de passe',
                    'attr' => [
                        'placeholder' => "Indique ton nouveau mot de passe"
                    ],
                    'hash_propety_path' => 'password'
                ],
                'second_options' => [
                    'label' => 'Confirme ton nouveau mot de passe',
                    'attr' => [
                        'placeholder' => "Confirme ton nouveau mot de passe"
                    ]
                ],
                'mapped' => false,
            ])
            ->add('submit', SubmitType::class, [
                "label" => "Mettre à jour mon mot de passe",
                'attr' => [
                    'class' => 'btn btn-success'
                ]
            ]);

        // Ajout de l'écouteur d'événements
        $builder->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) {
            $form = $event->getForm();
            $user = $form->getConfig()->getOptions()['data'];
            $passwordHasher = $form->getConfig()->getOptions()['passwordHasher'];

            // Récupérer le mot de passe saisi par l'utilisateur et le comparer au mot de passe de la BDD
            $isValid = $passwordHasher->isPasswordValid(
                $user->getPassword(), // Assurez-vous d'utiliser la méthode pour obtenir le mot de passe haché
                $form->get('actualPassword')->getData()
            );

            // Si erreur
            if (!$isValid) {
                $form->get('actualPassword')->addError(new FormError("Le mot de passe ne correspond pas"));
            }
        });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'passwordHasher' => null, // Ajout de l'option passwordHasher
        ]);
    }
}
