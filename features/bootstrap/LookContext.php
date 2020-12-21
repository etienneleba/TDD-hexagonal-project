<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Modules\Core\Adapters\InMemoryHeightRepository;
use Modules\Core\Adapters\InMemoryLookRepository;
use Modules\Core\Adapters\InMemoryMorphologyRepository;
use Modules\Core\Adapters\InMemoryPartRepository;
use Modules\Core\Application\CreateLook\CreateLookCommand;
use Modules\Core\Application\CreateLook\CreateLookHandler;
use Modules\Core\Domain\Model\Height;
use Modules\Core\Domain\Model\Look;
use Modules\Core\Domain\Model\Mannequin;
use Modules\Core\Domain\Model\Morphology;
use Modules\Core\Domain\Model\Part;
use function PHPUnit\Framework\assertCount;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertInstanceOf;
use function PHPUnit\Framework\assertTrue;

class LookContext implements Context
{
    private $lookRepository;
    private $partRepository;
    private $heightRepository;
    private $morphologyRepository;
    private Look $createdLook;

    public function __construct()
    {
        $this->lookRepository = new InMemoryLookRepository();
        $this->heightRepository = new InMemoryHeightRepository();
        $this->partRepository = new InMemoryPartRepository();
        $this->morphologyRepository = new InMemoryMorphologyRepository();
    }

    /**
     * @Given some heights exist
     */
    public function someHeightsExist(TableNode $table)
    {

        $heightStrings = $table->getColumn(0);
        array_shift($heightStrings);
        $heightStrings = array_values($heightStrings);

        foreach ($heightStrings as $heightString) {
            $height = Height::createFromString($heightString);
            $this->heightRepository->add($height);
            assertTrue(in_array($height, $this->heightRepository->all()));

        }
    }

    /**
     * @Given /^some parts exist$/
     */
    public function somePartsExist(TableNode $table)
    {
        $partStrings = $table->getColumn(0);
        array_shift($partStrings);
        $partStrings = array_values($partStrings);

        foreach ($partStrings as $partString) {
            $part = Part::createFromString($partString);
            $this->partRepository->add($part);
            assertTrue(in_array($part, $this->partRepository->all()));
        }
    }

    /**
     * @Given some morphologies exist
     */
    public function someMorphologiesExist(TableNode $table)
    {
        $morphologyStrings = $table->getColumn(0);
        array_shift($morphologyStrings);
        $morphologyStrings = array_values($morphologyStrings);


        foreach ($morphologyStrings as $morphologyString) {
            $morphology = Morphology::createFromString($morphologyString);
            $this->morphologyRepository->add($morphology);
            assertTrue(in_array($morphology, $this->morphologyRepository->all()));
        }
    }


    /**
     * @When I create a look with the name :name
     */
    public function iCreateALookWithTheName($name)
    {
        $createLookCommand = new CreateLookCommand($name);
        $createLookCommandHandler = new CreateLookHandler($this->lookRepository, $this->heightRepository, $this->morphologyRepository, $this->partRepository);
        $createLookCommandHandler->handle($createLookCommand);
    }

    /**
     * @Then the look should be created
     */
    public function theLookShouldBeCreated()
    {
        assertCount(1, $this->lookRepository->all());
        $this->createdLook = $this->lookRepository->all()[0];
    }

    /**
     * @Given the look should have the name :name
     */
    public function theLookShouldHaveTheName($name)
    {
        assertEquals($name, $this->createdLook->getName());
    }

    /**
     * @Given the look should have a mannequin for each combination of height and morphology
     */
    public function theLookShouldHaveAMannequinForEachCombinationOfHeightAndMorphology()
    {
        $allMannequinCombinations = $this->getAllMannequinCombinations();

        $mannequins = $this->createdLook->getMannequins();
        assertCount(count($allMannequinCombinations), $mannequins);
        foreach ($allMannequinCombinations as $mannequinCombination) {
            assertTrue(in_array($mannequinCombination, $mannequins));
        }

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
     * @Given the mannequins should have a part for each existing parts
     */
    public function theMannequinsShouldHaveAPartForEachExistingParts()
    {
        $allExistingParts = $this->partRepository->all();

        $mannequins = $this->createdLook->getMannequins();
        foreach ($mannequins as $mannequin) {
            $mannequinParts = $mannequin->getParts();
            assertCount(count($allExistingParts), $mannequinParts);
            foreach ($allExistingParts as $existingPart) {
                assertTrue(in_array($existingPart, $mannequinParts));
            }
        }
    }



}