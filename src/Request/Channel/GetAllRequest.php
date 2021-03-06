<?php

namespace StadGent\Services\OpeningHours\Request\Channel;

use StadGent\Services\OpeningHours\Request\RequestAbstract;
use StadGent\Services\OpeningHours\Uri\Channel\GetAllUri;

/**
 * Request to get all Channels for the given Service Id.
 *
 * @package StadGent\Services\OpeningHours\Request\Channel
 */
class GetAllRequest extends RequestAbstract
{
    /**
     * Get all channels for a service by the Service Id.
     *
     * @param int $serviceId
     *   The Service ID to get all channels for.
     */
    public function __construct($serviceId)
    {
        $uri = new GetAllUri($serviceId);
        parent::__construct($uri);
    }
}
