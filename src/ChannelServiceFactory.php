<?php

namespace StadGent\Services\OpeningHours;

use StadGent\Services\OpeningHours\Client\ClientInterface;
use Psr\SimpleCache\CacheInterface;
use StadGent\Services\OpeningHours\Handler\Channel\GetAllHandler;
use StadGent\Services\OpeningHours\Handler\Channel\GetByIdHandler;
use StadGent\Services\OpeningHours\Handler\Channel\OpeningHoursDayHtmlHandler;
use StadGent\Services\OpeningHours\Handler\Channel\OpeningHoursHandler;
use StadGent\Services\OpeningHours\Handler\Channel\OpeningHoursMonthHtmlHandler;
use StadGent\Services\OpeningHours\Handler\Channel\OpeningHoursPeriodHtmlHandler;
use StadGent\Services\OpeningHours\Handler\Channel\OpeningHoursWeekHtmlHandler;
use StadGent\Services\OpeningHours\Handler\Channel\OpeningHoursYearHtmlHandler;
use StadGent\Services\OpeningHours\Handler\Channel\OpenNowHandler;
use StadGent\Services\OpeningHours\Handler\Channel\OpenNowHtmlHandler;

/**
 * Factory to create the ChannelService.
 *
 * @package StadGent\Services\OpeningHours
 */
class ChannelServiceFactory
{
    /**
     * Expects a Client object.
     *
     * Will add the package handlers and inject the client and optional cache
     * into the ServiceService.
     *
     * @param \StadGent\Services\OpeningHours\Client\ClientInterface $client
     * @param \Psr\SimpleCache\CacheInterface $cache
     *
     * @return \StadGent\Services\OpeningHours\ChannelService
     */
    public static function create(ClientInterface $client, CacheInterface $cache = null)
    {
        $client
            ->addHandler(new GetAllHandler())
            ->addHandler(new GetByIdHandler())
            ->addHandler(new OpenNowHandler())
            ->addHandler(new OpenNowHtmlHandler())
            ->addHandler(new OpeningHoursHandler())
            ->addHandler(new OpeningHoursDayHtmlHandler())
            ->addHandler(new OpeningHoursWeekHtmlHandler())
            ->addHandler(new OpeningHoursMonthHtmlHandler())
            ->addHandler(new OpeningHoursYearHtmlHandler())
            ->addHandler(new OpeningHoursPeriodHtmlHandler())
        ;

        $service = new ChannelService($client);
        if ($cache) {
            $service->setCacheService($cache);
        }

        return $service;
    }
}
