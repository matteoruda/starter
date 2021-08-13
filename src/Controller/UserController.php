<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Route("/user", name="user_")
 */
class UserController extends AbstractController
{

    /**
     * @Route("/", name="list")
     */
    public function list(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();

        return $this->render('user/index.html.twig', [
            'title' => 'Lista utenti',
            'description' => 'Gestisci gli utenti',
            'users' => $users,
        ]);
    }

    /**
     * @Route("/create", name="create")
     */
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new User();

        $form = $this->createForm(UserType::class, $user, ['role' => $this->getUser()->getRoles() ]);

        $form->handleRequest($request);

        if(  $form->isSubmitted() && $form->isValid() )
        {
            $entityManager->persist($user);
            $entityManager->flush();
            $this->redirectToRoute('user_list');
        }

        return $this->render('user/form.html.twig', [
            'title' => 'Crea un nuovo utente',
            'description' => 'Inserisci un nuovo utente nel sistema',
            'createUserForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/edit/{id}", name="edit")
     */
    public function edit(Request $request, EntityManagerInterface $entityManager, UserInterface $user): Response
    {
        $form = $this->createForm(UserType::class, $user, ['role' => $this->getUser()->getRoles() ]);

        $form->handleRequest($request);

        if(  $form->isSubmitted() && $form->isValid() )
        {
            $entityManager->persist($user);
            $entityManager->flush();
            $this->redirectToRoute('user_list');
        }

        return $this->render('user/form.html.twig', [
            'title' => "Modifica utente",
            'description' => "Modifica i dati dell' utente {$user->getFirstName()} {$user->getLastName()} ",
            'createUserForm' => $form->createView()
        ]);
    }
}
