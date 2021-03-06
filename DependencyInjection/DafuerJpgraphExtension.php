<?php

namespace Dafuer\JpgraphBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class DafuerJpgraphExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
        
        $container->setParameter('dafuer_jpgraph.constants', $config['constants']);
        if(isset($config['graph_viewer_default'])){
            $container->setParameter('dafuer_jpgraph.graph_viewer_default', $config['graph_viewer_default']);
        }else{
            $container->setParameter('dafuer_jpgraph.graph_viewer_default', array());
        }
    }
    
     
}
