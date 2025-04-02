<?php

namespace App\Factory;

use App\Entity\VideoGame;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<VideoGame>
 */
final class VideoGameFactory extends PersistentProxyObjectFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
    }

    public static function class(): string
    {
        return VideoGame::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array
    {
        return [
            'title' => self::faker()->text(255),
            'releaseDate' => self::faker()->dateTime(),
            'developer' => self::faker()->text(255),
            'description' => self::faker()->text(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(VideoGame $videoGame): void {})
        ;
    }
}
