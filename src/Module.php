<?php
/*
* This file is part of prooph/link.
 * (c) prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Date: 06.12.14 - 21:26
 */

namespace Prooph\Link\Monitor;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

/**
 * Class Module
 *
 * This module is responsible for monitoring workflow processes performed by the processing workflow processor.
 * It registers an own plugin on the processing environment to log processing states.
 * The collected information is presented in the UI.
 * The monitor module is also able to read the event stream of a process and translate the recorded events
 * into readable information for the user.
 *
 * @package Prooph\Link\Monitor
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}
