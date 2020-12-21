<?php
declare(strict_types=1);


namespace Modules\Core\Application\CreateLook;

use Modules\Core\Domain\HeightRepository;
use Modules\Core\Domain\LookFactory;
use Modules\Core\Domain\LookRepository;
use Modules\Core\Domain\Model\Look;
use Modules\Core\Domain\MorphologyRepository;
use Modules\Core\Domain\PartRepository;

class CreateLookHandler
{
    private LookRepository $lookRepository;
    private HeightRepository $heightRepository;
    private MorphologyRepository $morphologyRepository;
    private PartRepository $partRepository;

    /**
     * CreateLookHandler constructor.
     * @param LookRepository $lookRepository
     * @param HeightRepository $heightRepository
     * @param MorphologyRepository $morphologyRepository
     * @param PartRepository $partRepository
     */
    public function __construct(LookRepository $lookRepository, HeightRepository $heightRepository, MorphologyRepository $morphologyRepository, PartRepository $partRepository)
    {
        $this->lookRepository = $lookRepository;
        $this->heightRepository = $heightRepository;
        $this->morphologyRepository = $morphologyRepository;
        $this->partRepository = $partRepository;
    }


    public function handle(CreateLookCommand $createLookCommand)
    {
        $lookName = $createLookCommand->getName();
        $lookFactory = new LookFactory($this->heightRepository, $this->morphologyRepository, $this->partRepository);
        $look = $lookFactory->createFromName($lookName);
        $this->lookRepository->add($look);


    }
}