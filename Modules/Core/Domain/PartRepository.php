<?php


namespace Modules\Core\Domain;


use Modules\Core\Domain\Model\Part;

interface PartRepository
{
    public function all(): array;

    public function add(Part $part): void;
}