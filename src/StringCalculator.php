<?php

namespace Deg540\StringCalculatorPHP;

class StringCalculator
{
    public function add(string $numbers): int
    {
        if (strpos($numbers, '//') === 0) {
            $delimiter = $numbers[2];
            $numbers = substr($numbers, 4);
        } else {
            $delimiter = ",|\n";
        }
        $numbers = preg_replace("/[$delimiter]/", ",", $numbers);
        if (str_contains($numbers, ',')) {
            $numbersArray = explode(',', $numbers);
            $negatives = array_filter($numbersArray, fn($number) => (int)$number < 0);
            if (!empty($negatives)) {
                throw new \InvalidArgumentException(
                    "negativos no soportados: " . implode(", ", $negatives)
                );
            }
            $numbersArray = array_filter($numbersArray, fn($number) => (int)$number <= 1000);
            return array_sum($numbersArray);
        }
        if (empty($numbers)) {
            return 0;
        }

        return $numbers;
    }
}
