<?php


namespace Modules\Core\Domain;


use Modules\Core\Domain\Model\Look;

interface LookRepository
{
    public function all(): array;

    public function add(Look $look): void;
}