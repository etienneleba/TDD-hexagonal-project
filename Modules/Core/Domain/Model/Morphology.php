<?php
declare(strict_types=1);


namespace Modules\Core\Domain\Model;


class Morphology
{
    private MorphologyCode $morphologyCode;

    /**
     * Morphology constructor.
     * @param MorphologyCode $morphologyCode
     */
    private function __construct(MorphologyCode $morphologyCode)
    {
        $this->morphologyCode = $morphologyCode;
    }

    public static function createFromString(string $code)
    {
        $morphologyCode = MorphologyCode::createFromString($code);

        return new Morphology($morphologyCode);
    }


}