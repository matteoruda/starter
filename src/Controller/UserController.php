<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Route("/user", name="user_")
 * @IsGranted("ROLE_ADMIN", message="Non hai i permessi per visualizzare questa pagina")
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
    public function create(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordEncoder): Response
    {
        $user = new User();

        $form = $this->createForm(UserType::class, $user, ['role' => $this->getUser()->getRoles() ]);

        $form->handleRequest($request);

        if(  $form->isSubmitted() && $form->isValid() )
        {
            $user->setPassword(
                $passwordEncoder->hashPassword( $user, $form->get('plainPassword')->getData() )
            );
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

        $form = $this->createForm(UserType::class, $user, [ 'role' => $this->getUser()->getRoles() ]);

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


    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete(User $user, EntityManagerInterface $entityManager): RedirectResponse
    {
        $user->setDeletedAt(new \DateTimeImmutable());

        $entityManager->persist($user);
        $entityManager->flush();

        $this->addFlash('success', 'Utente cancellato con successo');
        return $this->redirectToRoute('user_list');
    }

    /**
     * @Route("/recover/{id}", name="recover")
     */
    public function recover(User $user, EntityManagerInterface $entityManager): RedirectResponse
    {
        $user->setDeletedAt(null);

        $entityManager->persist($user);
        $entityManager->flush();

        $this->addFlash('success', 'Utente ripristinato con successo');
        return $this->redirectToRoute('user_list');
    }
}
