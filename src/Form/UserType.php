<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Role;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
// contraintes
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
// Password
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('email')
            ->add('password', PasswordType::class)
            ->add('confirm',PasswordType::class)
            ->add('role', EntityType::class, [
                    'class' => Role::class,
                    'choice_label' => 'nom',
                    // used to render a select box, check boxes or radios
                    // 'multiple' => true,
                    'expanded' => false,
                    ]);
             /*->add('roles', ChoiceType::class, [
                'choices'  => [                     
                            'ROLE_SUPER_ADMIN' => 'gere les admins et utilisateurs',
                            'ROLE_ADMIN' => 'gere les utilisateurs',
                            'ROLE_USER' => 'Utilisateur general',
                            'ROLE_PARENT' => 'Parent',
                            'ROLE_COMPTABLE' => 'Comptable',
                            'ROLE_LIBRAIRE' => 'LIBRAIRE',
                            'ROLE_PROF' => 'Professeur',
                            'ROLE_ETUDIANT' => 'Etudiant',]
               ]);
               ->add('roles', ChoiceType::class, [
                'choices'  => [                     
                            'ROLE_SUPER_ADMIN',
                            'ROLE_ADMIN' ,]
               ]);*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
