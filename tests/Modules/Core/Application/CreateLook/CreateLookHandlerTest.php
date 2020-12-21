<?php

namespace Modules\Core\Application\CreateLook;

use Modules\Core\Adapters\InMemoryHeightRepository;
use Modules\Core\Adapters\InMemoryLookRepository;
use Modules\Core\Adapters\InMemoryMorphologyRepository;
use Modules\Core\Adapters\InMemoryPartRepository;
use Modules\Core\Domain\HeightRepository;
use Modules\Core\Domain\LookFactory;
use Modules\Core\Domain\LookRepository;
use Modules\Core\Domain\Model\Height;
use Modules\Core\Domain\Model\Look;
use Modules\Core\Domain\Model\Mannequin;
use Modules\Core\Domain\Model\Morphology;
use Modules\Core\Domain\Model\Part;
use Modules\Core\Domain\MorphologyRepository;
use Modules\Core\Domain\PartRepository;
use PHPUnit\Framework\TestCase;

class CreateLookHandlerTest extends TestCase
{
    private LookRepository $lookRepository;
    private HeightRepository  $heightRepository;
    private MorphologyRepository $morphologyRepository;
    private PartRepository $partRepository;
    private CreateLookCommand $createLookCommand;
    private CreateLookHandler  $createLookHandler;
    private const HEIGHTS = [
        'small',
        'average',
        'tall'
    ];
    private const MORPHOLOGY = [
        'X',
        'H',
        'A',
        'V',
        'O',
        '8'
    ];
    private const PARTS = [
        'top',
        'bottom',
        'shoes',
        'accessories'
    ];

    /**
     * @return Look
     */
    public function createAndGetLook(): Look
    {
        $this->createLook("look Noël 2020");

        $createdLook = $this->getCreatedLook();
        return $createdLook;
    }


    /**
     * SETUP
     */

    protected function setUp(): void
    {
        parent::setUp();
        $this->lookRepository = new InMemoryLookRepository();
        $this->heightRepository = new InMemoryHeightRepository();
        $this->morphologyRepository = new InMemoryMorphologyRepository();
        $this->partRepository = new InMemoryPartRepository();

        foreach ($this::HEIGHTS as $HEIGHT) {
            $this->heightRepository->add(Height::createFromString($HEIGHT));
        }

        foreach ($this::MORPHOLOGY as $MORPHOLOGY) {
            $this->morphologyRepository->add(Morphology::createFromString($MORPHOLOGY));
        }

        foreach ($this::PARTS as $PART) {
            $this->partRepository->add(Part::createFromString($PART));
        }
    }

    /**
     * TESTS
     */

    public function testTheLookShouldBeCreated()
    {
        $this->assertCanCreateLook();
    }

    public function testTheLookShouldHaveTheName()
    {
        $this->assertLookHasTheRightName('look automne/hiver 2020');

    }

    public function testWithAnotherNameTheLookShouldHaveTheRightName()
    {
        $this->assertLookHasTheRightName("look Noël 2020");
    }

    public function testTheLookShouldHaveAMannequinForEachCombinationOfHeightAndMorphology()
    {

        $createdLook = $this->createAndGetLook();

        $this->assertTheLookHaveAMannequinForEachCombinationOfHeightAndMorphology($createdLook);
    }

    public function testTheMannequinsShouldHaveAPartForEachExistingParts()
    {
        $createdLook = $this->createAndGetLook();

        $allExistingParts = $this->partRepository->all();

        $mannequins = $createdLook->getMannequins();

        /**
         * @var Mannequin $mannequin
         */
        foreach ($mannequins as $mannequin) {

            $mannequinParts = $mannequin->getParts();
            $this->assertCount(count($allExistingParts), $mannequinParts);
            foreach ($mannequinParts as $mannequinPart) {
                $this->assertInstanceOf(Part::class, $mannequinPart);
            }
            foreach ($allExistingParts as $existingPart) {
                $this->assertTrue(in_array($existingPart, $mannequinParts));
            }
        }
    }


    /**
     * HELP METHODS
     *
     */

    public function createLook(string $name): void
    {
        $this->createLookCommand = new CreateLookCommand($name);
        $this->createLookHandler = new CreateLookHandler($this->lookRepository, $this->heightRepository, $this->morphologyRepository, $this->partRepository);
        $this->createLookHandler->handle($this->createLookCommand);
    }

    public function getCreatedLook(): Look
    {
        return $this->lookRepository->all()[0];
    }

    public function getAllMannequinCombinations(): array
    {
        $allMannequinCombinations = [];
        $allParts = $this->partRepository->all();
        foreach ($this->heightRepository->all() as $height) {
            foreach ($this->morphologyRepository->all() as $morphology) {
                $allMannequinCombinations[] = Mannequin::createFromHeightAndMorphologyAndParts($height, $morphology, $allParts);
            }
        }
        return $allMannequinCombinations;
    }



    /**
     * ASSERTS
     */


    public function assertCanCreateLook(): void
    {
        $this->createLook("look automne/hiver 2020");

        $this->assertCount(1, $this->lookRepository->all());
    }


    public function assertLookHasTheRightName(string $name): void
    {
        $lookName = "look Noël 2020";
        $this->createLook($lookName);
        $createdLook = $this->getCreatedLook();
        $this->assertEquals($lookName, $createdLook->getName());
    }

    /**
     * @param Look $createdLook
     */
    public function assertTheLookHaveAMannequinForEachCombinationOfHeightAndMorphology(Look $createdLook): void
    {
        $allMannequinCombinations = $this->getAllMannequinCombinations();

        $mannequins = $createdLook->getMannequins();
        $this->assertCount(count($allMannequinCombinations), $mannequins);
        foreach ($allMannequinCombinations as $mannequinCombination) {
            $this->assertTrue(in_array($mannequinCombination, $mannequins));
        }
    }





}
