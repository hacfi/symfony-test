<?php

declare(strict_types=1);

namespace App\Bundle\CompanyBundle\DependencyInjection;

use App\Kernel;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    /** @var string */
    protected $alias;

    public function __construct(string $alias)
    {
        $this->alias = $alias;
    }

    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder($this->alias);

        $this->configureRootNode($treeBuilder->getRootNode()); // @phpstan-ignore-line

        return $treeBuilder;
    }

    protected function configureRootNode(ArrayNodeDefinition $rootNode): void
    {
        $this->addCompanySection($rootNode);
    }

    private function addCompanySection(ArrayNodeDefinition $rootNode): void
    {
        $rootNode
            ->children()
            ->end()
        ;
    }
}
