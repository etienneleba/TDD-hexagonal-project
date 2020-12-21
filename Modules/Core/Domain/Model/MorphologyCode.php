<?php
declare(strict_types=1);


namespace Modules\Core\Domain\Model;


class MorphologyCode
{
    private string $code;


    /**
     * MorphologyCode constructor.
     * @param string $code
     */
    private function __construct(string $code)
    {
        $this->code = $code;
    }

    public static function createFromString(string $code) {
        return new MorphologyCode($code);
    }

}