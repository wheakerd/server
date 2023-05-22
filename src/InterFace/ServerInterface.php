<?php
declare(strict_types=1);

namespace Wheakerd\Server\InterFace;
interface ServerInterface
{
    /**
     * HTTP 服务器
     */
    public const SERVER_HTTP = 1;

    /**
     * WebSocket 服务器
     */
    public const SERVER_WEBSOCKET = 2;

    /**
     * HTTP 服务器
     */
    public const SERVER_BASE = 3;
}