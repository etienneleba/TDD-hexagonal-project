<?php


namespace Modules\Core\Domain;


use Modules\Core\Domain\Model\Morphology;

interface MorphologyRepository
{
    public function all(): array;

    public function add(Morphology $morphology): void;
}