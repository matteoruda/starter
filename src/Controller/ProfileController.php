<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ChangePasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="profile")
     */
    public function index(Request $request, UserInterface $user, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): Response
    {
        $passwordForm = $this->createForm(ChangePasswordType::class);

        $passwordForm->handleRequest($request);

        if($passwordForm->isSubmitted() && $passwordForm->isValid())
        {
            $password = $passwordForm->get('password')->getData();
            $user->setPassword( $passwordHasher->hashPassword($user, $password) );
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'Password cambiate con successo');
        }

        return $this->render('profile/index.html.twig', [
            'title' => 'Pagina del profilo',
            'description' => 'Visualizza e gestisci il tuo profilo',
            'passwordForm' => $passwordForm->createView(),
            'user' => $user
        ]);
    }
}
