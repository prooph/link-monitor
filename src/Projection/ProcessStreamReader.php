<?php
/*
* This file is part of prooph/link.
 * (c) prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * Date: 1/23/15 - 1:43 PM
 */
namespace Prooph\Link\Monitor\Projection;

use Prooph\Common\Messaging\DomainEvent;
use Prooph\Processing\Processor\ProcessId;
use Prooph\EventStore\EventStore;
use Prooph\EventStore\Stream\StreamName;

/**
 * Class ProcessStreamReader
 *
 * @package Prooph\Link\Monitor\Projection
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
final class ProcessStreamReader
{
    /**
     * @var EventStore
     */
    private $eventStore;

    /**
     * @param EventStore $eventStore
     */
    public function __construct(EventStore $eventStore)
    {
        $this->eventStore = $eventStore;
    }

    /**
     * @param ProcessId $processId
     * @param int $minVersion
     * @return DomainEvent[]
     */
    public function getStreamOfProcess(ProcessId $processId, $minVersion = 0)
    {
        return $this->eventStore->loadEventsByMetadataFrom(
            new StreamName('prooph_processing_stream'),
            ['aggregate_id' => $processId->toString()],
            $minVersion
        );
    }
} 