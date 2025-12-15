<?php

namespace Graycore\GraphQlLogger\Test\Unit\Plugin;

use Graycore\GraphQlLogger\Model\Config;
use Graycore\GraphQlLogger\Plugin\LogDataPlugin;
use Magento\Framework\App\RequestInterface;
use Magento\GraphQl\Helper\Query\Logger\LogData;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class LogDataPluginTest extends TestCase
{
    /**
     * @var Config|MockObject
     */
    private $configMock;

    /**
     * @var LogData|MockObject
     */
    private $logDataMock;

    /**
     * @var RequestInterface|MockObject
     */
    private $requestMock;

    /**
     * @var LogDataPlugin
     */
    private LogDataPlugin $plugin;

    protected function setUp(): void
    {
        $this->configMock = $this->createMock(Config::class);
        $this->logDataMock = $this->createMock(LogData::class);
        $this->requestMock = $this->createMock(RequestInterface::class);

        $this->plugin = new LogDataPlugin($this->configMock);
    }

    /**
     * Test that query is added to result when logger is enabled
     */
    public function testAfterGetLogDataAddsQueryWhenEnabled(): void
    {
        $this->configMock->expects($this->once())
            ->method('isEnabled')
            ->willReturn(true);

        $result = ['existing' => 'data'];
        $data = ['query' => '{__typename}'];

        $actual = $this->plugin->afterGetLogData(
            $this->logDataMock,
            $result,
            $this->requestMock,
            $data
        );

        $this->assertArrayHasKey('query', $actual);
        $this->assertEquals('{__typename}', $actual['query']);
        $this->assertEquals('data', $actual['existing']);
    }

    /**
     * Test that result is unchanged when logger is disabled
     */
    public function testAfterGetLogDataReturnsUnchangedResultWhenDisabled(): void
    {
        $this->configMock->expects($this->once())
            ->method('isEnabled')
            ->willReturn(false);

        $result = ['existing' => 'data'];
        $data = ['query' => '{__typename}'];

        $actual = $this->plugin->afterGetLogData(
            $this->logDataMock,
            $result,
            $this->requestMock,
            $data
        );

        $this->assertArrayNotHasKey('query', $actual);
        $this->assertEquals($result, $actual);
    }
}
