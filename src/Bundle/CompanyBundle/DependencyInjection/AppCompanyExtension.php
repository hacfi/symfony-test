<?php

declare(strict_types=1);

namespace App\Bundle\CompanyBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;

final class AppCompanyExtension extends ConfigurableExtension implements PrependExtensionInterface
{
    public const ALIAS = 'app_company';

    /**
     * {@inheritdoc}
     */
    public function getConfiguration(array $config, ContainerBuilder $container)
    {
        return new Configuration($this->getAlias());
    }

    /**
     * {@inheritdoc}
     */
    public function getAlias(): string
    {
        return self::ALIAS;
    }

    /**
     * {@inheritdoc}
     */
    protected function loadInternal(array $mergedConfig, ContainerBuilder $container)
    {
    }

    public function prepend(ContainerBuilder $container)
    {
        $configs = $container->getExtensionConfig($this->getAlias());
        $config = $this->processConfiguration($this->getConfiguration($configs, $container), $configs);

        $twigConfig = [
            'form_themes' => [
                '@AppCompany/form_div_layout.html.twig',
            ],
        ];

        $container->prependExtensionConfig('twig', $twigConfig);
    }
}
