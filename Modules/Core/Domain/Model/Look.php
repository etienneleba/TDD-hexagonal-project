<?php
declare(strict_types=1);


namespace Modules\Core\Domain\Model;


class Look
{
    private string $name;
    private array $mannequins;
    private static array $heights;
    private static array $morphologies;

    /**
     * Look constructor.
     * @param string $name
     * @param array $mannequins
     */
    private function __construct(string $name, array $mannequins)
    {
        $this->name = $name;
        $this->mannequins = $mannequins;
    }

    public static function createFromName(string $name): Look
    {
        return new Look($name, []);
    }

    public static function createFromNameAndMannequins(string $name, array  $mannequins): Look
    {
        return new Look($name, $mannequins);
    }


    public function getName()
    {
        return $this->name;
    }

    public function getMannequins(): array
    {
        return $this->mannequins;
    }


}