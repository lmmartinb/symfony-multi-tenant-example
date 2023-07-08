<?php

declare(strict_types=1);

namespace App\Doctrine;

use Doctrine\DBAL\Connection;

class DynamicConnection extends Connection
{

    public function swapDatabase(string $urlConnection): void
    {
        $this->closePreviousConnection();

        $params = $this->prepareConnectionParameters($urlConnection);

        parent::__construct($params, $this->_driver, $this->_config, $this->_eventManager);
    }

    private function commitPreviousTransactionIfActive(bool $isTransactionActive): void
    {
        if ($isTransactionActive) {
            $this->commit();
        }
    }

    private function closePreviousConnection(): void
    {
        if ($this->isConnected()) {
            $this->close();
        }
    }

    private function prepareConnectionParameters(string $urlConnection): array
    {
        $dbConnectionExploder = new DBConnectionChainExploder($urlConnection);
        return [
            'url'      => $dbConnectionExploder->url(),
            'host'     => $dbConnectionExploder->host(),
            'user'     => $dbConnectionExploder->user(),
            'password' => $dbConnectionExploder->password(),
            'port'     => $dbConnectionExploder->port(),
            'dbname'   => $dbConnectionExploder->database()
        ];
    }

}