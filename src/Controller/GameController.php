<?php

namespace App\Controller;

use App\Entity\VideoGame;
use App\Form\VideoGameType;
use App\Repository\VideoGameRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class GameController extends AbstractController
{
    #[Route('/games', name: 'games_list')]
    public function index(VideoGameRepository $videogameRepository, PaginatorInterface $paginator, Request $request)
    {
        $query = $videogameRepository->createQueryBuilder('g')->getQuery();

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1), // numéro de page
            4 // nombre d'éléments par page
        );

        return $this->render('game/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    #[Route('/game/{id}', name: 'game_show', requirements: ['id' => '\d+'])]
    public function show(int $id, VideoGameRepository $videogameRepository)
    {
        $game = $videogameRepository->find($id);
        // dd($game);

        if (!$game) {
            throw $this->createNotFoundException('Jeu non trouvé.');
        }

        return $this->render('game/show.html.twig', [
            'game' => $game,
        ]);
    }

    
    #[Route('/game/create', name: 'game_create')]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $game = new VideoGame();
        $form = $this->createForm(VideoGameType::class, $game);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($game);
            $em->flush();

            return $this->redirectToRoute('games_list');
        }

        return $this->render('game/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/game/{id}/edit', name: 'game_edit')]
    public function edit(VideoGame $game, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(VideoGameType::class, $game);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('games_list');
        }

        return $this->render('game/edit.html.twig', [
            'form' => $form->createView(),
            'game' => $game,
        ]);
    }
}
