<?php

namespace App\EventSubscriber;

use App\Repository\PlanetRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Presta\SitemapBundle\Event\SitemapPopulateEvent;
use Presta\SitemapBundle\Service\UrlContainerInterface;
use Presta\SitemapBundle\Sitemap\Url\UrlConcrete;

class PageCacheSubscriber implements EventSubscriberInterface
{
    public function __construct(private PlanetRepository $blogPostRepository)
    {
    }

    /**
     * @inheritdoc
     */
    public static function getSubscribedEvents()
    {
        return [
            SitemapPopulateEvent::class => 'populate',
        ];
    }

    /**
     * @param SitemapPopulateEvent $event
     */
    public function populate(SitemapPopulateEvent $event): void
    {
        $this->registerBlogPostsUrls($event->getUrlContainer(), $event->getUrlGenerator());
    }

    /**
     * @param UrlContainerInterface $urls
     * @param UrlGeneratorInterface $router
     */
    public function registerBlogPostsUrls(UrlContainerInterface $urls, UrlGeneratorInterface $router): void
    {
        $posts = $this->blogPostRepository->findAll();

        foreach ($posts as $post) {
            $urls->addUrl(
                new UrlConcrete(
                    $router->generate(
                        'blog_post',
                        ['slug' => $post->getSlug()],
                        UrlGeneratorInterface::ABSOLUTE_URL
                    )
                ),
                'blog'
            );
        }
    }
}
