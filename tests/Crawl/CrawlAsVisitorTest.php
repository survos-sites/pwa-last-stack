<?php

namespace App\Tests\Crawl;

use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\TestWith;
use Survos\CrawlerBundle\Tests\BaseVisitLinksTest;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CrawlAsVisitorTest extends BaseVisitLinksTest
{
	#[TestDox('/$method $url ($route)')]
	#[TestWith(['', 'App\Entity\User', '/', 200])]
	#[TestWith(['', 'App\Entity\User', '/voyage/', 200])]
	#[TestWith(['', 'App\Entity\User', '/planet/', 200])]
	#[TestWith(['', 'App\Entity\User', '/about', 200])]
	#[TestWith(['', 'App\Entity\User', '/swiper', 200])]
	#[TestWith(['', 'App\Entity\User', '/onsen', 200])]
	#[TestWith(['', 'App\Entity\User', '/planet/1', 200])]
	#[TestWith(['', 'App\Entity\User', '/planet/2', 200])]
	#[TestWith(['', 'App\Entity\User', '/planet/3', 200])]
	#[TestWith(['', 'App\Entity\User', '/planet/4', 200])]
	#[TestWith(['', 'App\Entity\User', '/planet/5', 200])]
	#[TestWith(['', 'App\Entity\User', '/planet/6', 200])]
	#[TestWith(['', 'App\Entity\User', '/?sort=purpose&sortDirection=asc', 200])]
	#[TestWith(['', 'App\Entity\User', '/?sort=leaveAt&sortDirection=asc', 200])]
	#[TestWith(['', 'App\Entity\User', '/voyage/6', 200])]
	#[TestWith(['', 'App\Entity\User', '/voyage/5', 200])]
	#[TestWith(['', 'App\Entity\User', '/voyage/4', 200])]
	#[TestWith(['', 'App\Entity\User', '/voyage/3', 200])]
	#[TestWith(['', 'App\Entity\User', '/voyage/2', 200])]
	#[TestWith(['', 'App\Entity\User', '/voyage/1', 200])]
	#[TestWith(['', 'App\Entity\User', '/?sort=purpose&sortDirection=desc', 200])]
	public function testRoute(string $username, string $userClassName, string $url, string|int|null $expected): void
	{
		parent::testWithLogin($username, $userClassName, $url, (int)$expected);
	}
}
