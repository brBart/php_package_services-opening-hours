<?php

namespace StadGent\Services\OpeningHours\Request;

/**
 * The different Accept types.
 */
class MethodType
{
    /**
     * GET sending method.
     *
     * @var string
     */
    const GET = 'GET';

    /**
     * POST sending method.
     *
     * @var string
     */
    const POST = 'POST';

    /**
     * PUT sending method.
     *
     * @var string
     */
    const PUT = 'PUT';

    /**
     * DELETE sending method.
     *
     * @var string
     */
    const DELETE  = 'DELETE';
}
