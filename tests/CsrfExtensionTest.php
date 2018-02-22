<?php

declare(strict_types=1);

namespace Wtf\Html\Tests;

use PHPUnit\Framework\TestCase;

class CsrfExtensionTest extends TestCase
{
    protected $extension;

    protected function setUp(): void
    {
        $dir = __DIR__.'/config/';
        $app = new \Wtf\App(['config_dir' => $dir]);
        $app->getContainer()->register(new \Wtf\Html\Provider());
        $this->extension = new \Wtf\Html\CsrfExtension($app->getContainer()->get('csrf_middleware'));
    }

    public function testGetName(): void
    {
        $this->assertEquals('slim/csrf', $this->extension->getName());
    }

    public function testGetGlobals(): void
    {
        $this->assertArrayHasKey('csrf', $this->extension->getGlobals());
    }
}
