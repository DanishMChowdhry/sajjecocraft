<?php

namespace Helpers;

use Exception;

class NumberToWords
{
    public static function convertNumberToWords($number)
    {
        // Ensure the input is a valid number

        // Remove commas (if any)
        $number = str_replace(',', '', $number);

        // Convert the number to a float to handle large numbers
        $number = (float) $number;
        if (!is_numeric($number)) {
            throw new Exception("Invalid Input: The provided value is not a valid number.");
        }

        // Separate the whole number and the decimal part
        $wholePart = floor($number);
        $decimalPart = round(($number - $wholePart) * 100); // Get the two decimal digits (e.g., 79 for .79)

        // Array of words for numbers
        $words = [
            0 => 'Zero', 1 => 'One', 2 => 'Two', 3 => 'Three', 4 => 'Four',
            5 => 'Five', 6 => 'Six', 7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
            10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve', 13 => 'Thirteen',
            14 => 'Fourteen', 15 => 'Fifteen', 16 => 'Sixteen', 17 => 'Seventeen',
            18 => 'Eighteen', 19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
            40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty', 70 => 'Seventy',
            80 => 'Eighty', 90 => 'Ninety', 100 => 'Hundred', 1000 => 'Thousand',
            100000 => 'Lakh', 10000000 => 'Crore'
        ];

        // Handle the whole part of the number
        $wholePartWords = self::convertWholeNumberToWords($wholePart, $words);

        // Handle the decimal part (in paise)
        $decimalPartWords = '';
        if ($decimalPart > 0) {
            $decimalPartWords = ' and ' . self::convertWholeNumberToWords($decimalPart, $words) . ' Paise';
        }

        // Combine both parts
        return $wholePartWords . $decimalPartWords;
    }

    // Helper function to convert whole number to words
    private static function convertWholeNumberToWords($number, $words)
    {
        // Handle small numbers directly
        if ($number < 20) {
            return $words[$number];
        }

        // Handle tens (20-99)
        elseif ($number < 100) {
            $tens = floor($number / 10) * 10;
            $ones = $number % 10;
            return $words[$tens] . ($ones ? ' ' . $words[$ones] : '');
        }

        // Handle hundreds (100-999)
        elseif ($number < 1000) {
            $hundreds = floor($number / 100);
            $remainder = $number % 100;
            return $words[$hundreds] . ' Hundred' . ($remainder ? ' and ' . self::convertWholeNumberToWords($remainder, $words) : '');
        }

        // Handle thousands (1,000-99,999)
        elseif ($number < 100000) {
            $thousands = floor($number / 1000);
            $remainder = $number % 1000;
            return self::convertWholeNumberToWords($thousands, $words) . ' Thousand' . ($remainder ? ' ' . self::convertWholeNumberToWords($remainder, $words) : '');
        }

        // Handle lakhs (1,00,000-99,99,999)
        elseif ($number < 10000000) {
            $lakhs = floor($number / 100000);
            $remainder = $number % 100000;
            return self::convertWholeNumberToWords($lakhs, $words) . ' Lakh' . ($remainder ? ' ' . self::convertWholeNumberToWords($remainder, $words) : '');
        }

        // Handle crores (1,00,00,000 and above)
        else {
            $crores = floor($number / 10000000);
            $remainder = $number % 10000000;
            return self::convertWholeNumberToWords($crores, $words) . ' Crore' . ($remainder ? ' ' . self::convertWholeNumberToWords($remainder, $words) : '');
        }
    }
}
