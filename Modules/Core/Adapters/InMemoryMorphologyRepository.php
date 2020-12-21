<?php
declare(strict_types=1);


namespace Modules\Core\Adapters;


use Modules\Core\Domain\Model\Morphology;
use Modules\Core\Domain\MorphologyRepository;

class InMemoryMorphologyRepository implements MorphologyRepository
{
    private array $morphologyCollection;

    /**
     * InMemoryMorphologyRepository constructor.
     */
    public function __construct()
    {
        $this->morphologyCollection = [];
    }

    public function add($morphology): void
    {
        $this->morphologyCollection[] = $morphology;
    }

    public function all(): array
    {
        return $this->morphologyCollection;
    }
}
