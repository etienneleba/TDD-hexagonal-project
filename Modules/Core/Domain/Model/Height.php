<?php
declare(strict_types=1);


namespace Modules\Core\Domain\Model;


class Height
{
    private string $name;

    /**
     * Height constructor.
     * @param string $name
     */
    private function __construct(string $name)
    {
        $this->name = $name;
    }


    public static function createFromString(string $heightString) {
        return new Height($heightString);
    }




}