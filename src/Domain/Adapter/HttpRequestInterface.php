<?php

declare(strict_types=1);

namespace AdgoalCommon\Base\Domain\Adapter;

/**
 * Interface HttpRequestInterface.
 *
 * @category Domain\Adapter
 */
interface HttpRequestInterface
{
    public const REQUEST_METHOD_GET = 'GET';
    public const REQUEST_METHOD_POST = 'POST';
    public const RESPONSE_STATUS_SUCCESS = 200;
    public const RESPONSE_STATUS_CREATED = 201;
    public const RESPONSE_HEADER_CONTENT_TYPE = 'content-type';
    public const RESPONSE_HEADER_CONTENT_TYPE_JSON = 'application/json';

    /**
     * Return request url.
     *
     * @return string
     */
    public function getUrl(): string;

    /**
     * Return request headers.
     *
     * @return string[]
     */
    public function getHeaders(): array;
}
