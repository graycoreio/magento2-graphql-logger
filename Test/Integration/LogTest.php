<?php

namespace Graycore\GraphQlLogger\Test\Integration;

use Graycore\GraphQlLogger\Api\Data\LogInterface;
use Graycore\GraphQlLogger\Api\LogRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\GraphQl\Controller\GraphQl;
use Magento\TestFramework\ObjectManager;
use Magento\TestFramework\Request;
use PHPUnit\Framework\TestCase;

/**
 * @magentoAppArea graphql
 */
class LogTest extends TestCase
{
    private $om;
    private $logRepository;

    protected function setUp(): void
    {
        $this->om = ObjectManager::getInstance();
        $this->logRepository = $this->om->get(LogRepositoryInterface::class);
    }

    private function getUniqueQuery(): string
    {
        return sprintf(
            '{__schema{types{%s:name}}}',
            'a'.uniqid() // graphql aliases cannot start with a number
        );
    }

    private function dispatchQuery(string $query): void
    {
        $this->om->get(GraphQl::class)->dispatch(
            $this->om->create(Request::class)
                ->setMethod('get')
                ->setParam('query', $query)
        );
    }

    private function dispatchQueryAndGetLog(string $query): LogInterface
    {
        $this->dispatchQuery($query);

        $queryHash = hash('sha256', $query);
        try {
            return $this->logRepository->getByHash($queryHash);
        } catch (NoSuchEntityException $e) {
            $this->fail($e->getMessage());
        }
    }

    /**
     * @magentoConfigFixture default/graphql/logger/enabled 1
     */
    public function testQueriesAreLogged(): void
    {
        $query = $this->getUniqueQuery();

        $log = $this->dispatchQueryAndGetLog($query);

        $this->assertEquals($log->getHash(), hash('sha256', $query));
        $this->assertEquals($log->getQuery(), $query);
    }

    /**
     * @magentoConfigFixture default/graphql/logger/enabled 1
     */
    public function testQueryLogsAreNotDuplicated(): void
    {
        $query = $this->getUniqueQuery();

        $firstLog  = $this->dispatchQueryAndGetLog($query);
        $secondLog = $this->dispatchQueryAndGetLog($query);

        $this->assertEquals($firstLog->getLogId(), $secondLog->getLogId());
    }

    /**
     * @magentoConfigFixture default/graphql/logger/enabled 0
     */
    public function testQueriesAreNotLoggedWhenLoggerIsDisabled(): void
    {
        $query = $this->getUniqueQuery();
        $this->dispatchQuery($query);

        $queryHash = hash('sha256', $query);
        try {
            $this->logRepository->getByHash($queryHash);
        } catch (NoSuchEntityException $e) {
            $this->assertTrue(true);
            return;
        }
        $this->fail('Query was logged despite logger being disabled.');
    }
}
