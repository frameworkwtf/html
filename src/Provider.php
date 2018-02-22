<?php

declare(strict_types=1);

namespace Wtf\Html;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class Provider implements ServiceProviderInterface
{
    public function register(Container $container): void
    {
        $container['csrf_middleware'] = function (Container $container) {
            $guard = new \Slim\Csrf\Guard();
            if ($callable = $container['config']('csrf.failure_callable')) {
                $guard->setFailureCallable($callable);
            }

            return $guard;
        };

        $container['session'] = function (Container $container) {
            return new \RKA\Session();
        };

        $container['session_middleware'] = function (Container $container) {
            return new \RKA\SessionMiddleware();
        };

        $container['flash'] = function (Container $container) {
            return new \Slim\Flash\Messages();
        };

        $container['view'] = function (Container $container) {
            $settings = $container['config']('html', []);
            $view = new \Slim\Views\Twig($settings['template_path'], [
                'cache' => $settings['cache_path'],
            ]);

            // Instantiate and add Slim specific extension
            $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
            $view->addExtension(new \Slim\Views\TwigExtension($container['router'], $basePath));
            $view->addExtension(new \Knlv\Slim\Views\TwigMessages($container['flash']));
            $view->addExtension(new \Wtf\Html\CsrfExtension($container['csrf_middleware']));

            return $view;
        };
    }
}
