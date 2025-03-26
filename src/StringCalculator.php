<?php

namespace Deg540\StringCalculatorPHP;

use http\Exception\InvalidArgumentException;
use function PHPUnit\Framework\isNull;
use function PHPUnit\Framework\throwException;

class StringCalculator
{
    // TODO: String Calculator Kata

    public function __construct()
    {
    }

    /**
     * @param string $numbers
     *
     * @return int
     * @throws \InvalidArgumentException
     */
    public function add(string $numbers): int {
        if ($this->isEmpty($numbers)) {
            return 0;
        }

        $cleanedString = $this->getCleanedString($numbers);

        $numbersArray = $this->getNumbersArray($cleanedString);

        $this->checkNegativeNumbers($numbersArray);

        if ($this->isOnlyOneNumber($numbersArray)) {
            return intval($numbersArray[0]);
        }

        return $this->getSum($numbersArray);
    }

    /**
     * @param string $numbers
     * @return bool
     */
    public function isEmpty(string $numbers): bool
    {
        return empty($numbers);
    }

    /**
     * @param string $numbers
     * @return string[]
     */
    private function getCleanedString(string $numbers): array
    {
        $delimiter = ",";
        if (str_starts_with($numbers, "//")) {
            if (preg_match("/\/\/\[(.+)]\n/", $numbers, $matches)) {
                $delimiter = preg_quote($matches[1],'/');
            }

            $numbers = substr($numbers, strpos($numbers, "\n") + 1);
        }

        return preg_split("/[$delimiter\n]/", $numbers);
    }

    /**
     * @param array $cleanedNumbersArray
     * @return array
     */
    private function getNumbersArray(array $cleanedNumbersArray): array
    {
        $numbersArray = [];
        foreach ($cleanedNumbersArray as $number) {
            if (intval($number) < 1000) {
                $numbersArray[] = $number;
            }
        }

        return $numbersArray;
    }

    /**
     * @param array $numbersArray
     * @return void
     */
    private function checkNegativeNumbers(array $numbersArray): void
    {
        $negativos = [];
        foreach ($numbersArray as $number) {
            if (intval($number) < 0) {
                $negativos[] = $number;
            }
        }

        if (!empty($negativos) > 0) {

            throw new \InvalidArgumentException("negativos no soportados: " . implode(", ", $negativos));
        }
    }

    /**
     * @param array $numbersArray
     * @return bool
     */
    private function isOnlyOneNumber(array $numbersArray): bool
    {
        return count($numbersArray) === 1;
    }

    /**
     * @param array $numbersArray
     * @return float|int
     */
    private function getSum(array $numbersArray): int|float
    {
        return array_sum(array_map('intval', $numbersArray));
    }

}