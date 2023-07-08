<?php

declare(strict_types=1);

namespace App\Doctrine;

class DBConnectionChainExploder
{
    private string $host;
    private string $user;
    private string $password;
    private string $port;
    private string $database;

    public function __construct(private string $url)
    {
        [$this->user, $this->password, $this->host, $this->port, $this->database] = $this->explodeUrl($url);
    }

    private function explodeUrl(string $url): array
    {
        preg_match('/mysql:\/\/(.*):(.*)@(.*):([0-9]+)\/([a-zA-Z0-9_\-]*)(\?charset=(.*))?/', $url, $matches);

        array_shift($matches);

        return $matches;
    }

    public function url(): string
    {
        return $this->url;
    }

    public function host(): string
    {
        return $this->host;
    }

    public function user(): string
    {
        return $this->user;
    }

    public function password(): string
    {
        return $this->password;
    }

    public function port(): string
    {
        return $this->port;
    }

    public function database(): string
    {
        return $this->database;
    }
}