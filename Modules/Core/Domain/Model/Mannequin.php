<?php
declare(strict_types=1);


namespace Modules\Core\Domain\Model;


class Mannequin
{
    private Height $height;
    private Morphology $morphology;
    private array $parts;

    /**
     * Mannequin constructor.
     * @param Height $height
     * @param Morphology $morphology
     * @param array $parts
     */
    public function __construct(Height $height, Morphology $morphology, array $parts)
    {
        $this->height = $height;
        $this->morphology = $morphology;
        $this->parts = $parts;
    }

    public static function createFromHeightAndMorphologyAndParts(Height $height, Morphology $morphology, array $parts): Mannequin
    {
        return new Mannequin($height, $morphology, $parts);
    }

    public function getParts(): array
    {
        return $this->parts;
    }

}