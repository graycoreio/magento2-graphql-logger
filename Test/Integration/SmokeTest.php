<?php

namespace Graycore\GraphQlLogger\Test\Integration;

use Magento\Framework\Serialize\Serializer\Json;
use Magento\GraphQl\Controller\GraphQl;
use Magento\TestFramework\ObjectManager;
use Magento\TestFramework\Request;
use PHPUnit\Framework\TestCase;

/**
 * @magentoAppArea graphql
 */
class SmokeTest extends TestCase
{
    private $om;
    private $serializer;
    private $graphqlController;

    protected function setUp(): void
    {
        $this->om = ObjectManager::getInstance();
        $this->serializer = $this->om->create(Json::class);
        $this->graphqlController = $this->om->get(GraphQl::class);
    }

    private function assertDispatch(Request $request): void
    {
        try {
            $response = $this->graphqlController->dispatch($request);
        } catch (\Exception $e) {
            $this->fail($e->getMessage());
        }
        $this->assertEquals($response->getStatusCode(), 200);
    }

    /**
     * @magentoConfigFixture default/graphql/logger/enabled 1
     */
    public function testGraphQlGetDispatch(): void
    {
        $this->assertDispatch(
            $this->om->create(Request::class)
                ->setMethod('get')
                ->setParam('query', '{__typename}')
        );
    }

    /**
     * @magentoConfigFixture default/graphql/logger/enabled 1
     */
    public function testGraphQlPostDispatch(): void
    {
        $request = $this->om->create(Request::class);
        $request->getHeaders()->addHeaderLine('Content-Type', 'application/json');

        $this->assertDispatch(
            $request
                ->setMethod('post')
                ->setContent($this->serializer->serialize(['query' => '{__typename}']))
        );
    }
}
