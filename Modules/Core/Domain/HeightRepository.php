<?php


namespace Modules\Core\Domain;


use Modules\Core\Domain\Model\Height;

interface HeightRepository
{
    public function all(): array;

    public function add(Height $height): void;

}