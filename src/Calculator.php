<?php

namespace App;

class Calculator
{
    public function add(string $numbers)
    {


        $separator = explode("\n", explode("//", $numbers, 2)[1], 2)[0] ?? false;

        if ($separator) {
            $parts = explode("\n", str_replace($separator, "\n", $numbers));
            unset($parts[0]);
        } else {

            $parts = explode("\n", str_replace(",", "\n", $numbers));
        }

        if (end($parts) === "") {
            throw new \InvalidArgumentException("Input cannot end with a separator");
        }
        $result = 0;
        foreach ($parts as $number) {
            if (!ctype_digit($number)) {
                throw new \InvalidArgumentException("Input must be a valid number");
            }
            $result += (int) $number;
        }
        return $result;
    }

}