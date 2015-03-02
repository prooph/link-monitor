<?php
/*
* This file is part of prooph/link.
 * (c) prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * Date: 21.01.15 - 17:42
 */

namespace Prooph\Link\Monitor\Service\Factory;

use Prooph\Link\Monitor\Service\DbalProcessLogger;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class DbalProcessLoggerFactory
 *
 * @package Prooph\Link\Monitor\Service\Factory
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
final class DbalProcessLoggerFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new DbalProcessLogger($serviceLocator->get('prooph.link.app.db'));
    }
}
 