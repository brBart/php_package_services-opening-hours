<?php

namespace StadGent\Services\Test\OpeningHours\Service\Channel;

use StadGent\Services\OpeningHours\Service\Channel\OpeningHoursService;
use StadGent\Services\OpeningHours\Request\Channel\OpeningHoursWeekRequest;
use StadGent\Services\OpeningHours\Response\OpeningHoursResponse;
use StadGent\Services\OpeningHours\Value\OpeningHours;
use StadGent\Services\Test\OpeningHours\Service\ServiceTestBase;

/**
 * Tests for ChannelService::openingHoursDayHtml Method.
 *
 * @package StadGent\Services\Test\OpeningHours
 */
class ChannelServiceOpeningHoursWeekTest extends ServiceTestBase
{
    /**
     * Test the openNow return object.
     */
    public function testOpeningHoursWeek()
    {
        $openingHours = $this->createOpeningHours();
        $client = $this->createClientForOpeningHours($openingHours);

        $channelService = new OpeningHoursService($client);
        $responseOpeningsHours = $channelService->getWeek(10, 20, '2020-01-02');
        $this->assertSame($openingHours, $responseOpeningsHours);
    }

    /**
     * Test the openNow return object from cache.
     */
    public function testOpeningHoursWeekFromCache()
    {
        $openingHours = $this->createOpeningHours();
        $client = $this->createClientForOpeningHours($openingHours);
        $cache = $this->getFromCacheMock(
            'OpeningHours:channel:value:week:10:20:2020-01-02',
            $openingHours
        );

        $channelService = new OpeningHoursService($client);
        $channelService->setCacheService($cache);
        $responseOpeningHours = $channelService->getWeek(10, 20, '2020-01-02');
        $this->assertSame($openingHours, $responseOpeningHours);
    }

    /**
     * Test the getByServiceAndChannelId setCache when not yet cached.
     */
    public function testOpeningHoursWeekSetCache()
    {
        $openingHours = $this->createOpeningHours();
        $client = $this->createClientForOpeningHours($openingHours);
        $cache = $this->getSetCacheMock(
            'OpeningHours:channel:value:week:12:34:2020-01-02',
            $openingHours
        );

        $channelService = new OpeningHoursService($client);
        $channelService->setCacheService($cache);
        $channelService->getWeek(12, 34, '2020-01-02');
    }

    /**
     * Helper to create an OpenNow object.
     *
     * @return \StadGent\Services\OpeningHours\Value\OpeningHours
     */
    protected function createOpeningHours()
    {
        return OpeningHours::fromArray(
            [
                'channel' => 'fooBar',
                'channelId' => 15,
                'openinghours' => [
                    '2022-04-02' => [
                        'date' => '2022-04-02',
                        'open' => false,
                        'hours' => [],
                    ],
                    '2022-04-03' => [
                        'date' => '2022-04-03',
                        'open' => false,
                        'hours' => [
                            [
                                'from' => '09:00',
                                'until' => '12:00',
                            ],
                        ],
                    ],
                    '2022-04-04' => [
                        'date' => '2022-04-04',
                        'open' => false,
                        'hours' => [],
                    ],
                    '2022-04-05' => [
                        'date' => '2022-04-05',
                        'open' => false,
                        'hours' => [],
                    ],
                    '2022-04-06' => [
                        'date' => '2022-04-06',
                        'open' => false,
                        'hours' => [],
                    ],
                    '2022-04-07' => [
                        'date' => '2022-04-07',
                        'open' => false,
                        'hours' => [],
                    ],
                    '2022-04-08' => [
                        'date' => '2022-04-08',
                        'open' => false,
                        'hours' => [],
                    ],
                ],
            ]
        );
    }

    /**
     * Helper to create a client that will return the given service.
     *
     * @param \StadGent\Services\OpeningHours\Value\OpeningHours $openingHours
     *
     * @return \StadGent\Services\OpeningHours\Client\ClientInterface
     */
    protected function createClientForOpeningHours(OpeningHours $openingHours)
    {
        $response = new OpeningHoursResponse($openingHours);
        $expectedRequest = OpeningHoursWeekRequest::class;
        return $this->getClientMock($response, $expectedRequest);
    }
}
