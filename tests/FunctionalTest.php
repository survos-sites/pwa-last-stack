<?php

namespace App\Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use Pierstoval\SmokeTesting\FunctionalSmokeTester;
use Pierstoval\SmokeTesting\FunctionalTestData;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FunctionalTest extends WebTestCase
{
    use FunctionalSmokeTester;

    public static function provideRoutes(): \Generator
    {
        yield 'GET /crawler/crawlerdata' => ['GET', '/crawler/crawlerdata', 'survos_crawler_data'];

        yield 'GET /' => ['GET', '/', 'app_homepage'];

        yield 'GET /swiper' => ['GET', '/swiper', 'app_swiper'];

        yield 'GET /onsen' => ['GET', '/onsen', 'app_onsen'];

        yield 'GET /about' => ['GET', '/about', 'app_about'];

        yield 'GET /offline' => ['GET', '/offline', 'app_offline_page'];

        yield 'GET /planet/' => ['GET', '/planet/', 'app_planet_index'];

        yield 'GET /planet/new' => ['GET', '/planet/new', 'app_planet_new'];

        yield 'POST /planet/new' => ['POST', '/planet/new', 'app_planet_new'];

        yield 'GET /voyage/' => ['GET', '/voyage/', 'app_voyage_index'];

        yield 'GET /voyage/new' => ['GET', '/voyage/new', 'app_voyage_new'];

        yield 'POST /voyage/new' => ['POST', '/voyage/new', 'app_voyage_new'];
    }

    #[DataProvider('provideRoutes')]
    /**
     * @dataProvider provideRoutes
     */
    public function testRoute(string $method, string $url, string $route): void
    {
        $this->runFunctionalTest(
            FunctionalTestData::withUrl($url)
                ->withMethod($method)
                ->expectRouteName($route)
                ->appendCallableExpectation($this->assertStatusCodeLessThan500($method, $url))
        );
    }

    public function assertStatusCodeLessThan500(string $method, string $url): \Closure
    {
        return static function (KernelBrowser $browser) use ($method, $url) {
            $statusCode = $browser->getResponse()->getStatusCode();
            $routeName = $browser->getRequest()->attributes->get('_route', 'unknown');

            static::assertLessThan(
                500,
                $statusCode,
                sprintf('Request "%s %s" for %s route returned an internal error.', $method, $url, $routeName),
            );
        };
    }
}
