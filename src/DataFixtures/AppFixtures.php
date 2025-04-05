<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Console;
use App\Entity\VideoGame;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Création des consoles
        $consoleNames = [
            'Nintendo 64',
            'Nintendo Switch',
            'Arcade',
            'Xbox Series',
            'GameCube',
            'Console virtuelle Wii',
            'Nintendo 3DS',
            'Windows',
        ];

        $consoleEntities = [];
        foreach ($consoleNames as $name) {
            $console = new Console();
            $console->setName($name);
            $manager->persist($console);
            $consoleEntities[$name] = $console; // On stocke l'objet pour le réutiliser plus tard
        }

        // Création des catégories
        $categoryNames = [
            'Plateforme',
            'Action',
            'Combat',
            'Jeu de tir à la première personne',
            'Action-aventure',
            'Tir à la troisième personne',
        ];

        $categoryEntities = [];
        foreach ($categoryNames as $name) {
            $category = new Category();
            $category->setName($name);
            $manager->persist($category);
            $categoryEntities[$name] = $category; // Idem
        }

        // Création des jeux vidéo
        $games = [
            [
                'title' => 'Super Mario 64',
                'releaseDate' => new \DateTime('1997-09-01'),
                'developer' => 'Nintendo EAD',
                'description' => 'Révolutionnaire pour son époque, Super Mario 64 est un jeu de plateformes en 3D où Mario explore le château de Peach pour récupérer des étoiles et affronter Bowser.',
                'consoles' => ['Nintendo 64', 'Nintendo Switch'],
                'categories' => ['Plateforme'],
            ],
            [
                'title' => 'Bomberman 64',
                'releaseDate' => new \DateTime('1997-11-14'),
                'developer' => 'Hudson Soft',
                'description' => 'Premier Bomberman en 3D, ce jeu propose une aventure solo où le joueur doit sauver la planète, ainsi qu’un mode multijoueur explosif.',
                'consoles' => ['Nintendo 64'],
                'categories' => ['Action'],
            ],
            [
                'title' => 'Mace: The Dark Age',
                'releaseDate' => new \DateTime('1997-10-01'),
                'developer' => 'Atari Games',
                'description' => 'Jeu de combat médiéval sanglant inspiré de Mortal Kombat, avec des personnages puissants et des affrontements intenses.',
                'consoles' => ['Arcade', 'Nintendo 64'],
                'categories' => ['Combat']
            ],
            [
                'title' => 'GoldenEye 007',
                'releaseDate' => new \DateTime('1997-08-25'),
                'developer' => 'Rare',
                'description' => 'Un FPS culte basé sur le film de James Bond, offrant un mode solo passionnant et un mode multijoueur légendaire en écran partagé.',
                'consoles' => ['Nintendo 64', 'Nintendo Switch', 'Xbox Series'],
                'categories' => ['Jeu de tir à la première personne']
            ],
            [
                'title' => 'The Legend of Zelda: Ocarina of Time',
                'releaseDate' => new \DateTime('1998-12-11'),
                'developer' => 'Nintendo EAD',
                'description' => 'Considéré comme l’un des meilleurs jeux de tous les temps, ce chef-d\'œuvre d’action-aventure suit Link dans sa quête contre Ganondorf.',
                'consoles' => ['Nintendo 64', 'GameCube', 'Console virtuelle Wii', 'Nintendo 3DS'],
                'categories' => ['Action-aventure']
            ],
            [
                'title' => 'Star Wars: Shadows of the Empire',
                'releaseDate' => new \DateTime('1997-01-01'),
                'developer' => 'LucasArts',
                'description' => 'Une aventure palpitante dans l’univers Star Wars, mêlant phases de tir et pilotage de vaisseaux avec Dash Rendar comme héros.',
                'consoles' => ['Nintendo 64', 'Windows'],
                'categories' => ['Action']
            ],
            [
                'title' => 'Mission Impossible',
                'releaseDate' => new \DateTime('1997-11-09'),
                'developer' => 'Infogrames',
                'description' => 'Jeu d’infiltration inspiré du film Mission Impossible, où le joueur doit accomplir des missions discrètes et stratégiques.',
                'consoles' => ['Nintendo 64'],
                'categories' => ['Tir à la troisième personne']
            ],
        ];

        foreach ($games as $data) {
            $game = new VideoGame();
            $game->setTitle($data['title']);
            $game->setReleaseDate($data['releaseDate']);
            $game->setDeveloper($data['developer']);
            $game->setDescription($data['description']);

            foreach ($data['consoles'] as $consoleName) {
                if (isset($consoleEntities[$consoleName])) {
                    $game->addConsole($consoleEntities[$consoleName]);
                }
            }

            foreach ($data['categories'] as $categoryName) {
                if (isset($categoryEntities[$categoryName])) {
                    $game->addCategory($categoryEntities[$categoryName]);
                }
            }

            $manager->persist($game);
        }

        $manager->flush();
    }
}
