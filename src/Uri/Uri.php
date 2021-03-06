<?php

namespace StadGent\Services\OpeningHours\Uri;

/**
 * Abstract implementation of the URI.
 *
 * @package StadGent\Services\OpeningHours\Uri\Channel
 */
class Uri implements UriInterface
{
    /**
     * The URI string.
     *
     * @var string
     */
    private $uri;

    /**
     * Construct the URI object from an URI string.
     *
     * @param string $uri
     */
    public function __construct($uri)
    {
        $this->uri = $uri;
    }

    /**
     * Get the URI as string.
     *
     * @return string
     *   The URI string.
     */
    public function getUri()
    {
        return $this->uri;
    }
}
