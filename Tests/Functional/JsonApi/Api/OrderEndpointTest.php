<?php
namespace RFY\Shop\Tests\Functional\JsonApi\Api;

use Neos\Flow\Persistence\Doctrine\PersistenceManager;
use Neos\Flow\Tests\FunctionalTestCase;
use RFY\Shop\Domain\Model\Order;

/**
 * Testcase for order
 */
class OrderEndpointTest extends FunctionalTestCase
{
    /**
     * @var boolean
     */
    protected static $testablePersistenceEnabled = true;

    public function setUp()
    {
        parent::setUp();
        if (!$this->persistenceManager instanceof PersistenceManager) {
            $this->markTestSkipped('Doctrine persistence is not enabled');
        }
    }

    /**
     * @test
     */
    public function assertEndpointOptions()
    {
        $response = $this->browser->request('http://localhost/api/v1/orders', 'OPTIONS');
        $this->assertEquals(204, $response->getStatusCode());
    }

    /**
     * @test
     */
    public function fetchingResourceList()
    {
        $this->markTestSkipped('resource listing');

        $entity1 = new Order();
        // Add required attributes
        $entity2 = new Order();
        // Add required attributes

        $this->persistenceManager->add($entity1);
        $this->persistenceManager->add($entity2);
        $this->persistenceManager->persistAll();
        $this->persistenceManager->clearState();

        $response = $this->browser->request('http://localhost/api/v1/orders', 'GET');
        $jsonResponse = \json_decode($response->getBody());

        $this->isJson($response->getBody());

        $this->assertSame('orders', $jsonResponse->data[0]->type);
        $this->assertSame('orders', $jsonResponse->data[1]->type);

        $entityIdentifier = $this->persistenceManager->getIdentifierByObject($entity2);
        $this->assertSame('http://localhost/Api/v1/orders/' . $entityIdentifier, $jsonResponse->data[0]->links->self);
        $entityIdentifier = $this->persistenceManager->getIdentifierByObject($entity1);
        $this->assertSame('http://localhost/Api/v1/orders/' . $entityIdentifier, $jsonResponse->data[1]->links->self);
    }

    /**
     * @test
     */
    public function fetchResource()
    {
        $this->markTestSkipped('get resource');

        $entity = new Order();
        // Add required attributes
        $this->persistenceManager->add($entity);
        $this->persistenceManager->persistAll();
        $this->persistenceManager->clearState();

        $entityIdentifier = $this->persistenceManager->getIdentifierByObject($entity);
        $response = $this->browser->request('http://localhost/api/v1/orders/' . $entityIdentifier, 'GET');
        $jsonResponse = \json_decode($response->getBody());

        $this->isJson($response->getBody());
        $this->assertSame('orders', $jsonResponse->data->type);
        $this->assertSame($entityIdentifier, $jsonResponse->data->id);

        // Add attributes check
        // $this->assertSame('Name #1', $jsonResponse->data->attributes->name);

        $this->assertSame('http://localhost/Api/v1/orders/' . $entityIdentifier, $jsonResponse->data->links->self);
    }

    /**
     * @test
     */
    public function createResource()
    {
        $this->markTestSkipped('create resource');

        $request['data'] = [
            'type' => 'orders',
            'attributes' => [
                // Add attributes
            ]
        ];

        $response = $this->browser->request('http://localhost/api/v1/orders', 'POST', [], [], [], \json_encode($request));
        $jsonResponse = \json_decode($response->getBody());

        $this->isJson($response->getBody());
        $this->assertEquals(201, $response->getStatusCode());
        $this->assertSame('orders', $jsonResponse->data->type);
        $this->assertNotNull($jsonResponse->data->id);

        // Add attributes check
        // $this->assertSame('Name #1', $jsonResponse->data->attributes->name);

        $this->assertStringStartsWith('http://localhost/Api/v1/orders/', $jsonResponse->data->links->self);
    }

    /**
     * @test
     */
    public function updateResource()
    {
        $this->markTestSkipped('update resource');

        $entity = new Order();
        // Add required attributes
        $this->persistenceManager->add($entity);
        $this->persistenceManager->persistAll();
        $this->persistenceManager->clearState();

        $entityIdentifier = $this->persistenceManager->getIdentifierByObject($entity);

        $request['data'] = [
            'type' => 'orders',
            'id' => $entityIdentifier,
            'attributes' => [
                // Add attributes
            ]
        ];

        $response = $this->browser->request('http://localhost/api/v1/orders/' . $entityIdentifier, 'PATCH', [], [], [], \json_encode($request));
        $jsonResponse = \json_decode($response->getBody());

        $this->isJson($response->getBody());
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertSame('orders', $jsonResponse->data->type);
        $this->assertEquals($entityIdentifier, $jsonResponse->data->id);

        // Add attributes check
        // $this->assertSame('Name #1', $jsonResponse->data->attributes->name);

        $this->assertStringStartsWith('http://localhost/Api/v1/orders/', $jsonResponse->data->links->self);
    }

    /**
     * @test
     */
    public function deleteResource()
    {
        $this->markTestSkipped('delete resource');

        $entity = new Order();
        // Add required attributes
        $this->persistenceManager->add($entity);
        $this->persistenceManager->persistAll();
        $this->persistenceManager->clearState();

        $entityIdentifier = $this->persistenceManager->getIdentifierByObject($entity);
        $response = $this->browser->request('http://localhost/api/v1/orders/' . $entityIdentifier, 'DELETE');

        $this->assertEquals(204, $response->getStatusCode());
    }

    /**
     * @test
     */
    public function validateResource()
    {
        $this->markTestSkipped('validate resource');
    }
}
