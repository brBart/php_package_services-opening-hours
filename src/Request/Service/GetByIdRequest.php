<?php

namespace StadGent\Services\OpeningHours\Request\Service;

use StadGent\Services\OpeningHours\Request\RequestAbstract;
use StadGent\Services\OpeningHours\Uri\Service\GetByIdUri;

/**
 * Request to get a Service by its ID.
 *
 * @package StadGent\Services\OpeningHours\Request\Service
 */
class GetByIdRequest extends RequestAbstract
{
    /**
     * Get a single Service by its ID.
     *
     * @param int $id
     *   The Service ID.
     */
    public function __construct($id)
    {
        $uri = new GetByIdUri($id);
        parent::__construct($uri);
    }
}
