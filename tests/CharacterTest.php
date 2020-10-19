<?php

require ('./autoload.php');

use App\Model\Charactere;
use PHPUnit\Framework\TestCase;

final class CharacterTest extends TestCase
{
    public function testCanSetStrengthWithPositiveValue(): void
    {
        // Initialisation
        $character = new Charactere();

        // Execution
        $newStrength = 10;
        $character->setStrength($newStrength);

        // Validation
        $this->assertEquals($newStrength, $character->getStrength());
    }

    public function testCannotSetStrengthWithNegativeValue(): void
    {
        // Initialisation
        $character = new Charactere();

        // Execution
        $newStrength =  - 10;
        $character->setStrength($newStrength);

        // Validation
        $this->assertEquals($newStrength, $character->getStrength());
    }
}