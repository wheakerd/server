<?php
declare(strict_types=1);

namespace Wheakerd\Server;


use Swoole\Http\Server as SwooleHttpServer;
use Swoole\Server as SwooleServer;
use Swoole\WebSocket\Server as SwooleWebSocketServer;
use Wheakerd\Server\Exception\RuntimeException;
use Wheakerd\Server\InterFace\ServerInterface;

class Server
{

    protected string $host = "";

    protected int $port;

    /**
     * 指定运行模式
     * @var array
     */
    protected array $mode = [
        SWOOLE_PROCESS,
        SWOOLE_BASE,
    ];

    /**
     * 指定 Server 的类型
     * @var array
     */
    protected array $sockType = [
        SWOOLE_TCP,
        SWOOLE_TCP6,
        SWOOLE_UDP,
        SWOOLE_UDP6,
        SWOOLE_SOCK_TCP,
        SWOOLE_SOCK_TCP6,
        SWOOLE_SOCK_UDP,
        SWOOLE_SOCK_UDP6,
        SWOOLE_UNIX_DGRAM,
        SWOOLE_UNIX_STREAM,
    ];

    protected null|SwooleServer $server = null;

    /**
     * 构造函数
     */
    public function __construct()
    {
    }

    public function init($config): ServerInterface
    {
        $this->initServer($config);
        return $this;
    }

    protected function initServer($config)
    {
    }

    public function start(): void
    {
        $this->server->start();
    }

    public function makeServer(int $type, string $host, int $port, int $mode, int $sockType): SwooleServer
    {
        return match ($type) {
            ServerInterface::SERVER_HTTP => new SwooleHttpServer($host, $port, $mode, $sockType),
            ServerInterface::SERVER_WEBSOCKET => new SwooleWebSocketServer($host, $port, $mode, $sockType),
            ServerInterface::SERVER_BASE => new SwooleServer($host, $port, $mode, $sockType),
            'default' => throw new RuntimeException('Server type is invalid.'),
        };
    }
}