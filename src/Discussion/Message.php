<?php
/**
 * @author      Wizacha DevTeam <dev@wizacha.com>
 * @copyright   Copyright (c) Wizacha
 * @license     Proprietary
 */
declare(strict_types = 1);

namespace Wizaplace\Discussion;

final class Message
{
    /** @var string */
    private $content;

    /** @var \DateTimeImmutable */
    private $date;

    /**
     * @internal
     */
    public function __construct(array $data)
    {
        $this->content = $data['content'];
        $this->date = new \DateTimeImmutable($data['date']);
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getDate(): \DateTimeImmutable
    {
        return $this->date;
    }
}
