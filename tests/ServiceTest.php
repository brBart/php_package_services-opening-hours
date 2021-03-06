<?php

namespace StadGent\Services\Test\OpeningHours;

use PHPUnit\Framework\TestCase;
use Psr\SimpleCache\CacheInterface;
use StadGent\Services\OpeningHours\Client\ClientInterface;
use StadGent\Services\OpeningHours\Handler\Service\GetAllHandler;
use StadGent\Services\OpeningHours\Handler\Service\GetByIdHandler;
use StadGent\Services\OpeningHours\Handler\Service\SearchByLabelHandler;
use StadGent\Services\OpeningHours\Service;
use StadGent\Services\OpeningHours\Service\Service\ServiceService;
use StadGent\Services\OpeningHours\Value\ServiceCollection;

/**
 * Class RoomServiceFactoryTest
 *
 * @package Gent\Zalenzoeker\Tests\Services\Room
 */
class ServiceTest extends TestCase
{

    /**
     * Test the create factory method.
     */
    public function testCreate()
    {
        // Handlers we expect to be added to the factory.
        $expectedHandlers = [
            GetAllHandler::class,
            GetByIdHandler::class,
            SearchByLabelHandler::class,
        ];

        // Create the client so we can spy on the factory method.
        $client = $this
            ->getMockBuilder(ClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        // Inject a spy so we can validate the injected handlers.
        $spy = $this->any();
        $client
            ->expects($spy)
            ->method('addHandler')
            ->will($this->returnValue($client));

        /* @var $client \StadGent\Services\OpeningHours\Client\Client */
        $service = Service::create($client);
        $this->assertInstanceOf(
            ServiceService::class,
            $service,
            'Service is an ServiceService.'
        );

        // Validate the number of handlers added.
        $expectedCount = count($expectedHandlers);
        $handlerCount = $spy->getInvocationCount();
        $this->assertSame(
            $expectedCount,
            $handlerCount,
            sprintf('%d handlers are added', $expectedCount)
        );

        // Validate the added handlers.
        $invocations = $spy->getInvocations();
        foreach ($invocations as $invocation) {
             /** @noinspection PhpUndefinedFieldInspection */
             $handler = get_class($invocation->parameters[0]);
             $this->assertTrue(
                 in_array($handler, $expectedHandlers, true),
                 sprintf('Handler "%s" is added by the factory.', $handler)
             );
        }
    }

    /**
     * Test if the factory method sets the Cache to the Service.
     */
    public function testCreateWithCache()
    {
        $collection = ServiceCollection::fromArray([]);

        $client = $this
            ->getMockBuilder(ClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
        $client
            ->expects($this->any())
            ->method('addHandler')
            ->will($this->returnValue($client));

        $cache = $this
            ->getMockBuilder(CacheInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
        $cache
            ->expects($this->once())
            ->method('get')
            ->with($this->equalTo('OpeningHours:service:value:all'))
            ->will($this->returnValue($collection));

        /* @var $client \StadGent\Services\OpeningHours\Client\Client */
        $service = Service::create($client, $cache);

        $responseCollection = $service->getAll();
        $this->assertSame($collection, $responseCollection);
    }
}
