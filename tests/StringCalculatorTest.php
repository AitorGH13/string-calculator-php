<?php

declare(strict_types=1);

namespace Deg540\StringCalculatorPHP\Test;

use Deg540\StringCalculatorPHP\StringCalculator;
use PHPUnit\Framework\TestCase;

class StringCalculatorTest extends TestCase
{
    private StringCalculator $stringCalculator;

    protected function setUp(): void
    {
        parent::setUp();
        $this->stringCalculator = new StringCalculator();
    }

    /**
     * @test
     */
    public function givenEmptyStringReturnsZero(): void
    {
        $this->assertEquals(0, $this->stringCalculator->add(""));
    }

    /**
     * @test
     */ 
    public function givenSingleNumberReturnsSameNumber(): void
    {
        $stringCalculator = new StringCalculator();
        $this->assertEquals(1, $this->stringCalculator->add("1"));
    }

    /**
     * @test
     */
    public function givenNumbersSeparatedByCommasReturnsSumOfNumbers(): void
    {
        $this->assertEquals(6, $this->stringCalculator->add("1,2,3"));
    }

    /**
     * @test
     */
    public function givenNumbersSeparatedByCommasAndLineBreakReturnsSumOfNumbers(): void
    {
        $this->assertEquals(6, $this->stringCalculator->add("1\n2,3"));  
    }

    /**
     * @test
     */
    public function givenNegativeNumbersThrowsExceptionWithAllNegativeNumbers(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("negativos no soportados: -1, -2, -3");
        $this->stringCalculator->add("1,-1,-2,-3"); 
    }

    /**
     * @test
     */
    public function givenNumbersGreaterThanThousandAreIgnoredAndReturnsSumOfNumbers(): void
    {
        $this->assertEquals(6, $this->stringCalculator->add("1,1001,2,2000,3")); 
    }

    /**
     * @test
     */
    public function givenNumbersSeparatedByCustomLargeDelimiterReturnsSumOfNumbers(): void
    {
        $this->assertEquals(6, $this->stringCalculator->add("//[***]\n1***2**3"));
    }

}
 