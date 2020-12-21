<?php
declare(strict_types=1);


namespace Modules\Core\Adapters;


use Modules\Core\Domain\LookRepository;
use Modules\Core\Domain\Model\Look;

class InMemoryLookRepository implements LookRepository
{
private array $lookCollection;

    /**
     * InMemoryLookRepository constructor.
     */
    public function __construct()
    {
        $this->lookCollection = [];
    }

    public function add(Look $look): void
    {
        $this->lookCollection[] = $look;
    }


    public function all(): array
    {
        return $this->lookCollection;
    }
}