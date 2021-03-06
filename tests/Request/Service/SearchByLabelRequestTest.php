<?php

namespace StadGent\Services\Test\OpeningHours\Request\Service;

use StadGent\Services\OpeningHours\Request\AcceptType;
use StadGent\Services\OpeningHours\Request\MethodType;
use StadGent\Services\OpeningHours\Request\Service\SearchByLabelRequest;
use PHPUnit\Framework\TestCase;

/**
 * Test the GetAllRequest object.
 *
 * @package StadGent\Services\Test\OpeningHours\Request\Service
 */
class SearchByLabelRequestTest extends TestCase
{
    /**
     * Test if the method is GET.
     */
    public function testMethodIsGet()
    {
        $request = new SearchByLabelRequest('FooBar');
        $this->assertEquals(MethodType::GET, $request->getMethod());
    }

    /**
     * Test if the proper endpoint (URI) is set.
     */
    public function testEndpoint()
    {
        $request = new SearchByLabelRequest('FooBar');
        $this->assertEquals('services?label=FooBar', $request->getRequestTarget());
    }

    /**
     * Test if the proper headers are set.
     */
    public function testHeaders()
    {
        $request = new SearchByLabelRequest('FooBar');
        $this->assertEquals(AcceptType::JSON, $request->getHeaderLine('Accept'));
    }
}
