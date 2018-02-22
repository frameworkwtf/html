<?php

declare(strict_types=1);

namespace Wtf\Html\Tests;

use PHPUnit\Framework\TestCase;
use Wtf\Html\Provider;

class ProviderTest extends TestCase
{
    protected $container;

    protected function setUp(): void
    {
        $dir = __DIR__.'/config/';
        $app = new \Wtf\App(['config_dir' => $dir]);
        $this->container = $app->getContainer();
        $this->container->register(new Provider());
    }

    public function testSession(): void
    {
        $this->assertInstanceOf('\RKA\Session', $this->container->session);
    }

    public function testSessionMiddleware(): void
    {
        $this->assertInstanceOf('\RKA\SessionMiddleware', $this->container->session_middleware);
    }

    public function testFlash(): void
    {
        $this->assertInstanceOf('\Slim\Flash\Messages', $this->container->flash);
    }

    public function testView(): void
    {
        $this->assertInstanceOf('\Slim\Views\Twig', $this->container->view);
    }
}
