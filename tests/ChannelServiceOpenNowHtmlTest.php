<?php

namespace StadGent\Services\Test\OpeningHours;

use StadGent\Services\OpeningHours\ChannelOpeningHoursHtmlService;
use StadGent\Services\OpeningHours\Request\Channel\OpenNowHtmlRequest;
use StadGent\Services\OpeningHours\Response\HtmlResponse;

/**
 * Tests for ServiceService::openNowHtml Method.
 *
 * @package StadGent\Services\Test\OpeningHours
 */
class ChannelServiceOpenNowHtmlTest extends ServiceTestBase
{
    /**
     * Test the HTML return string.
     */
    public function testOpenNow()
    {
        $html = $this->createOpenNowHtml();
        $client = $this->createClientForOpenNowHtml($html);

        $channelService = new ChannelOpeningHoursHtmlService($client);
        $responseHtml = $channelService->openNow(10, 20);
        $this->assertSame($html, $responseHtml);
    }

    /**
     * Test the openNow return HTML from cache.
     */
    public function testOpenNowHtmlFromCache()
    {
        $html = $this->createOpenNowHtml();
        $client = $this->createClientForOpenNowHtml($html);
        $cache = $this->getFromCacheMock('OpeningHours:ChannelOpeningHoursHtmlService:openNow:10:20', $html);

        $channelService = new ChannelOpeningHoursHtmlService($client);
        $channelService->setCacheService($cache);
        $responseHtml = $channelService->openNow(10, 20);
        $this->assertSame($html, $responseHtml);
    }

    /**
     * Test the openNow setCache when not yet cached.
     */
    public function testOpenNowHtmlSetCache()
    {
        $html = $this->createOpenNowHtml();
        $client = $this->createClientForOpenNowHtml($html);
        $cache = $this->getSetCacheMock('OpeningHours:ChannelOpeningHoursHtmlService:openNow:12:34', $html);

        $channelService = new ChannelOpeningHoursHtmlService($client);
        $channelService->setCacheService($cache);
        $channelService->openNow(12, 34);
    }

    /**
     * Test the Service not found exception.
     *
     * @expectedException \StadGent\Services\OpeningHours\Exception\ServiceNotFoundException
     */
    public function testServiceNotFoundException()
    {
        $client = $this->getClientWithServiceNotFoundExceptionMock();
        $channelService = new ChannelOpeningHoursHtmlService($client);
        $channelService->openNow(777, 666);
    }

    /**
     * Test the Channel not found exception.
     *
     * @expectedException \StadGent\Services\OpeningHours\Exception\ChannelNotFoundException
     */
    public function testChannelNotFoundException()
    {
        $client = $this->getClientWithChannelNotFoundExceptionMock();
        $channelService = new ChannelOpeningHoursHtmlService($client);
        $channelService->openNow(1, 666);
    }

    /**
     * Helper to create an OpenNow HTML string.
     *
     * @return string
     *   The HTML string.
     */
    protected function createOpenNowHtml()
    {
        return '<div>Open</div>';
    }

    /**
     * Helper to create a client that will return the given service.
     *
     * @param string $html
     *   The HTML string to return.
     *
     * @return \StadGent\Services\OpeningHours\Client\ClientInterface
     */
    protected function createClientForOpenNowHtml($html)
    {
        $response = new HtmlResponse($html);
        $expectedRequest = OpenNowHtmlRequest::class;
        return $this->getClientMock($response, $expectedRequest);
    }
}
