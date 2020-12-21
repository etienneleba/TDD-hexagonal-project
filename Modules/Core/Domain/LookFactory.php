<?php
declare(strict_types=1);


namespace Modules\Core\Domain;


use Modules\Core\Domain\Model\Look;
use Modules\Core\Domain\Model\Mannequin;

class LookFactory
{
    private HeightRepository $heightRepository;
    private MorphologyRepository $morphologyRepository;
    private PartRepository  $partRepository;

    /**
     * LookFactory constructor.
     * @param HeightRepository $heightRepository
     * @param MorphologyRepository $morphologyRepository
     * @param PartRepository $partRepository
     */
    public function __construct(HeightRepository $heightRepository, MorphologyRepository $morphologyRepository, PartRepository $partRepository)
    {
        $this->heightRepository = $heightRepository;
        $this->morphologyRepository = $morphologyRepository;
        $this->partRepository = $partRepository;
    }


    public function createFromName(String $name): Look
    {
        $allParts = $this->partRepository->all();
        $mannequins = [];
        foreach ($this->heightRepository->all() as $height) {
            foreach ($this->morphologyRepository->all() as $morphology) {
                $mannequins[] = Mannequin::createFromHeightAndMorphologyAndParts($height, $morphology, $allParts);
            }
        }
        return Look::createFromNameAndMannequins($name,$mannequins);
    }
}