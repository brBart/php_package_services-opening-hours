<?php

namespace StadGent\Services\Test\OpeningHours\Client\Configuration;

use StadGent\Services\OpeningHours\Configuration\Configuration;
use PHPUnit\Framework\TestCase;

/**
 * Test the Client/Configuration object.
 *
 * @package StadGent\Services\Test\OpeningHours\Client\Configuration
 */
class ConfigurationTest extends TestCase
{
    /**
     * Test constructor without options.
     */
    public function testConstructorWithoutOptions()
    {
        $uri = 'https://test-endpoint.stad.gent';
        $configuration = new Configuration($uri);

        $this->assertEquals($uri, $configuration->getUri(), 'Uri is set.');

        // Default options
        $this->assertEquals(
            20,
            $configuration->getTimeout(),
            'Default timeout is 20s.'
        );
    }

    /**
     * Test constructor with options.
     */
    public function testConstructorWithOptions()
    {
        $options = [
            'timeout' => 10,
        ];
        $configuration = new Configuration(
            'https://foo.com',
            $options
        );

        // Custom options
        $this->assertEquals(
            $options['timeout'],
            $configuration->getTimeout(),
            'Timeout is set to custom value.'
        );
    }
}
