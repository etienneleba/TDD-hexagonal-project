<?php
declare(strict_types=1);


namespace Modules\Core\Application\CreateLook;


class CreateLookCommand
{
    private string $name;

    /**
     * CreateLookCommand constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }


    public function getName()
    {
        return $this->name;
    }
}