<?php

namespace Application\Frontend;

use Phalcon\DiInterface;
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Config;


class Module implements ModuleDefinitionInterface
{
    /**
     * Registers an autoloader related to the module
     *
     * @param DiInterface $di
     */
    public function registerAutoloaders(DiInterface $di = null)
    {
        $loader = new Loader();

        $loader->registerNamespaces(array(
            'Application\Frontend\Controllers' => __DIR__ . '/controllers/',
            'Application\Frontend\Models'      => __DIR__ . '/models/'
        ));

        $loader->register();
    }

    /**
     * Registers services related to the module
     *
     * @param DiInterface $di
     */
    public function registerServices(DiInterface $di)
    {
        /**
         * Read common configuration
         */
         $config = $di->has('config') ? $di->getShared('config') : null;

        /**
         * Try to load local configuration
         */
        if (file_exists(__DIR__ . '/config/config.php')) {
            $override = new Config(include __DIR__ . '/config/config.php');;

            if ($config instanceof Config) {
                $config->merge($override);
            } else {
                $config = $override;
            }
        }

        /**
         * Setting up the view component
         */
		$view = $di->get('view');
		$view->setViewsDir($config->get('application')->viewsDir); 
		$di->set('view', $view);

		// add default namespace
		$dispatcher = $di->get('dispatcher');
		$dispatcher->setDefaultNamespace("Application\Frontend\Controllers");
		$di->set('dispatcher', $dispatcher);
    }
}
