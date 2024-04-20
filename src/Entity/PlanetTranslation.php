<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Webfactory\Bundle\PolyglotBundle\Entity\BaseTranslation;
use App\Entity\Planet;
use Webfactory\Bundle\PolyglotBundle\Attribute as Polyglot;
use Webfactory\Bundle\PolyglotBundle\TranslatableInterface;

#[ORM\Table]
#[ORM\UniqueConstraint(columns: ['entity_id', 'locale'])]
#[ORM\Entity]
class PlanetTranslation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column]
    #[Polyglot\Locale]
    protected string $locale;

    #[ORM\ManyToOne(targetEntity: Planet::class, inversedBy: 'translations')]
    private Planet $entity;

    public function getLocale(): string
    {
        return $this->locale;
    }

    #[ORM\Column]
    private string $text;
}
