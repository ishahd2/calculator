<?php

namespace App;

class Calculator
{
    public function add(string $numbers)
    {
        $separator = explode("\n", explode("//", $numbers, 2)[1], 2)[0] ?? false;
        $numberPart = '';

        if ($separator) {
            $numberPart = explode("\n", $numbers, 2)[1];
            $parts = explode("\n", str_replace($separator, "\n", $numberPart));
        } else {
            $parts = explode("\n", str_replace(",", "\n", $numbers));
        }

        if (end($parts) === "") {
            throw new \InvalidArgumentException("Input cannot end with a separator");
        }

        $result = 0;
        foreach ($parts as $number) {
            $position = strpos($numberPart, ",");
            if ($position !== false) {
                throw new \InvalidArgumentException("'$separator' expected but '$numberPart[$position]' found at position $position.");
            }
            if (!ctype_digit($number)) {
                throw new \InvalidArgumentException("Input must be a valid number");
            }

            $result += (int) $number;
        }
        return $result;
    }

}