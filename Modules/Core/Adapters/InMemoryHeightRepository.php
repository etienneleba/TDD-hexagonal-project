<?php
declare(strict_types=1);


namespace Modules\Core\Adapters;


use Modules\Core\Domain\HeightRepository;
use Modules\Core\Domain\Model\Height;

class InMemoryHeightRepository implements HeightRepository
{
private array $heightCollection;
    /**
     * InMemoryHeightRepository constructor.
     */
    public function __construct()
    {
        $this->heightCollection = [];
    }

    public function add(Height $height): void
    {
        $this->heightCollection[] = $height;
    }

    public function all(): array
    {
        return $this->heightCollection;
    }
}