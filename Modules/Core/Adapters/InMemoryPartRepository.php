<?php
declare(strict_types=1);


namespace Modules\Core\Adapters;


use Modules\Core\Domain\Model\Part;
use Modules\Core\Domain\PartRepository;

class InMemoryPartRepository implements PartRepository
{
    private array $partCollection;



    public function all(): array
    {
        return $this->partCollection;
    }

    public function add(Part $part): void
    {
        $this->partCollection[] = $part;
    }

    /**
     * InMemoryPartRepository constructor.
     */
    public function __construct()
    {
        $this->partCollection = [];
    }
}