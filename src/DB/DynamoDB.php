<?php

namespace App\DB;

use Aws\DynamoDb\DynamoDbClient;
use Aws\Credentials\CredentialProvider;

class DynamoDB implements DB {

    private $client;

    public function connect()
    {
        $provider = CredentialProvider::defaultProvider();

        $this->client = DynamoDbClient::factory(array(
            'version' => '2012-08-10',
            'credentials' => $provider,
            'region'  => 'sa-east-1'
        ));
    }

    public function update(array $statement)
    {
        $response = $this->client->updateItem($statement);
        return $response;
    }

    public function findOne(array $statement)
    {
        $response = $this->client->getItem($statement);
        return $response;
    }

    public function create(array $statement)
    {
        $response = $this->client->putItem($statement);
        return $response;
    }

    public function beginTransaction()
    {

    }

    public function endTransaction()
    {

    }
}