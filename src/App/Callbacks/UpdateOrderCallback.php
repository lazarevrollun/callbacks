<?php

namespace App\Callbacks;

use Psr\Log\LoggerInterface;
use rollun\callback\Callback\Interrupter\InterrupterInterface;
use rollun\datastore\DataStore\Interfaces\DataStoreInterface;
use rollun\dic\InsideConstruct;
use Xiag\Rql\Parser\Node\LimitNode;
use Xiag\Rql\Parser\Node\Query\ArrayOperator\InNode;
use Xiag\Rql\Parser\Query;

class UpdateOrderCallback implements UpdateOrderCallbackInterface
{
    public function __construct(private LoggerInterface $logger, private DataStoreInterface $dataStore) {}

    public function __invoke($value): string
    {
        $statusNode = new InNode('status', ['Incompleted']);
        $limitNOde = new LimitNode($value);

        $query = new Query();
        $query->setQuery($statusNode);
        $query->setLimit($limitNOde);
        $res = $this->dataStore->query($query);

        foreach ($res as $item) {
            $this->dataStore->update([
                'id' => $item['id'],
                'status' => 'Completed',
            ]);
        }
        $this->logger->notice(__METHOD__);
        return self::class;
    }

    public function __sleep(): array
    {
        return ['dataStore'];
    }

    public function __wakeup(): void
    {
       InsideConstruct::initWakeup([
           'logger' => LoggerInterface::class,
       ]);
    }
}