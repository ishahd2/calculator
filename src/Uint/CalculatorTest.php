<?php

namespace App\Uint;

include 'vendor/autoload.php';
use App\Calculator;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    public function testIfAddMethodWorks()
    {
        $calculator = new Calculator();

        $result = $calculator->add("10,3");

        $result2 = $calculator->add("10,3,7");

        $result3 = $calculator->add("10,3,7,4");

        $this->assertEquals(13, $result);
        $this->assertEquals(20, $result2);
        $this->assertEquals(24, $result3);
    }

    public function testAddMethodWithUnknownArguments()
    {
        $calculator = new Calculator();

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Input must be a valid number");

        $calculator->add("10,three");
    }

    public function testAddMethodHandlesNewlinesAsSeparators()
    {
        $calculator = new Calculator();

        $result = $calculator->add("1,2\n3");

        $this->assertEquals(6, $result);

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Input must be a valid number");
        $calculator->add("2,\n3");


    }

    public function testAddMethodDoesNotAllowCommaSeparatorAtEnd()
    {
        $calculator = new Calculator();

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Input cannot end with a separator");
        $calculator->add("1,2,");
    }

    public function testAddMethodDoesNotAllowNewlineSeparatorAtEnd()
    {
        $calculator = new Calculator();

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Input cannot end with a separator");
        $calculator->add("1,2\n");
    }

    public function testAddMethodHandlesDifferentSeparators()
    {
        $calculator = new Calculator();

        $result = $calculator->add("//;\n1;3");

        $this->assertEquals(4, $result);
    }
}