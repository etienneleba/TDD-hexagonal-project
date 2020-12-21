<?php
declare(strict_types=1);


namespace Modules\Core\Domain\Model;


class Part
{
    private string $name;

    /**
     * Part constructor.
     * @param string $name
     */
    private function __construct(string $name)
    {
        $this->name = $name;
    }

    public static function createFromString(string $name): Part
    {
        return new Part($name);
    }
}