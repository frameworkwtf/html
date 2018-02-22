<?php

declare(strict_types=1);

namespace Wtf\Html;

/**
 * slim/csrf twig extension.
 *
 * @author slim
 *
 * @see https://github.com/slimphp/Slim-Csrf#accessing-the-token-pair-in-templates-twig-etc
 */
class CsrfExtension extends \Twig\Extension\AbstractExtension implements \Twig\Extension\GlobalsInterface
{
    /**
     * @var \Slim\Csrf\Guard
     */
    protected $csrf;

    /**
     * @var \Slim\Csrf\Guiard
     */
    public function __construct(\Slim\Csrf\Guard $csrf)
    {
        $this->csrf = $csrf;
    }

    /**
     * {@inheritdoc}
     */
    public function getGlobals(): array
    {
        // CSRF token name and value
        $csrfNameKey = $this->csrf->getTokenNameKey();
        $csrfValueKey = $this->csrf->getTokenValueKey();
        $csrfName = $this->csrf->getTokenName();
        $csrfValue = $this->csrf->getTokenValue();

        return [
            'csrf' => [
                'keys' => [
                    'name' => $csrfNameKey,
                    'value' => $csrfValueKey,
                ],
                'name' => $csrfName,
                'value' => $csrfValue,
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return 'slim/csrf';
    }
}
