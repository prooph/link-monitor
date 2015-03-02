<?php
/*
* This file is part of prooph/link.
 * (c) prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * Date: 20.01.15 - 22:26
 */

namespace Prooph\Link\Monitor\Controller;

use Prooph\Link\Application\Service\TranslatorAwareController;
use Prooph\Link\Dashboard\Controller\AbstractWidgetController;
use Prooph\Link\Dashboard\View\DashboardWidget;
use Prooph\Link\Monitor\Model\ProcessLogger;
use Zend\Mvc\I18n\Translator;
use Zend\View\Model\ViewModel;

/**
 * Class ProcessesOverviewController
 *
 * @package Prooph\Link\Monitor\src\Controller
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
final class ProcessesOverviewController extends AbstractWidgetController implements TranslatorAwareController
{
    /**
     * @var ProcessLogger
     */
    private $processLogger;

    /**
     * @var Translator
     */
    private $translator;

    /**
     * @param ProcessLogger $processLogger
     */
    public function __construct(ProcessLogger $processLogger)
    {
        $this->processLogger = $processLogger;
    }

    /**
     * @return DashboardWidget
     */
    public function widgetAction()
    {
        $lastLoggedProcesses = $this->processLogger->getLastLoggedProcesses(0, 3);

        if (empty($lastLoggedProcesses)) return false;

        $this->addProcessNames($lastLoggedProcesses);

        return DashboardWidget::initialize(
            'prooph/link/monitor/process-view/partial/process-list',
            $this->translator->translate('Workflow Monitor'),
            12,
            ['processes' => $lastLoggedProcesses]
        );
    }

    /**
     * @return ViewModel
     */
    public function overviewAction()
    {
        $lastLoggedProcesses = $this->processLogger->getLastLoggedProcesses(0, 10);

        $this->addProcessNames($lastLoggedProcesses);

        $view = new ViewModel(['processes' => $lastLoggedProcesses]);

        $view->setTemplate('prooph/link/monitor/process-view/overview');

        return $view;
    }

    /**
     * @param array $processLogEntries
     */
    private function addProcessNames(array &$processLogEntries)
    {
        $processDefinitions = $this->systemConfig->getProcessDefinitions();

        foreach ($processLogEntries as &$processLogEntry) {
            if (isset($processDefinitions[$processLogEntry['start_message']])) {

                $processLogEntry['process_name'] = $processDefinitions[$processLogEntry['start_message']]['name'];
            } else {
                $processLogEntry['process_name'] = $this->translator->translate('Unknown');
            }
        }
    }

    /**
     * @param Translator $translator
     * @return void
     */
    public function setTranslator(Translator $translator)
    {
        $this->translator = $translator;
    }
}
 