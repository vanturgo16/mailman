<?php
namespace App\Traits;
use Carbon\Carbon;

trait GenerateNumber
{
    public function generateNumbering($pattern, $number)
    {
        // Current date for date replacements
        $currentDate = Carbon::now();

        // Replace the autonumber format (@)
        if (preg_match('/@{\d+}/', $pattern, $matches)) {
            $autonumberFormat = $matches[0];
            $digits = (int) filter_var($autonumberFormat, FILTER_SANITIZE_NUMBER_INT);
            $formattedNumber = str_pad($number, $digits, '0', STR_PAD_LEFT);
            $pattern = str_replace($autonumberFormat, $formattedNumber, $pattern);
        }

        // Replace date placeholders (#MM, #DD, #YYYY)
        if (strpos($pattern, '#^MM') !== false) {
            $romanMonth = $this->toRoman((int) $currentDate->format('m'));
            $pattern = str_replace('#^MM', $romanMonth, $pattern);
        } else {
            $pattern = str_replace('#MM', $currentDate->format('m'), $pattern);
        }
        if (strpos($pattern, '#^DD') !== false) {
            $romanDay = $this->toRoman((int) $currentDate->format('d'));
            $pattern = str_replace('#^DD', $romanDay, $pattern);
        } else {
            $pattern = str_replace('#MM', $currentDate->format('d'), $pattern);
        }
        if (strpos($pattern, '#^YYYY') !== false) {
            $romanYear = $this->toRoman((int) $currentDate->format('Y'));
            $pattern = str_replace('#^YYYY', $romanYear, $pattern);
        } else {
            $pattern = str_replace('#YYYY', $currentDate->format('Y'), $pattern);
        }

        // Replace Roman numeral format (^)
        if (preg_match('/@\{\^\d+\}/', $pattern, $matches)) {
            $romanNumeralFormat = $matches[0];
            $digits = (int) filter_var($romanNumeralFormat, FILTER_SANITIZE_NUMBER_INT);
            $formattedNumber = $this->toRoman($number);
            $pattern = str_replace($romanNumeralFormat, $formattedNumber, $pattern);
        }

        // Remove single quotes
        $pattern = str_replace("'", '', $pattern);

        return $pattern;
    }

    public function generateNumberingWithout($pattern, $number)
    {
        // Current date for date replacements
        $currentDate = Carbon::now();

        // Replace the autonumber format (@)
        if (preg_match('/@{\d+}/', $pattern, $matches)) {
            $autonumberFormat = $matches[0];
            $pattern = str_replace($autonumberFormat, $number, $pattern);
        }

        // Replace date placeholders (#MM, #DD, #YYYY)
        if (strpos($pattern, '#^MM') !== false) {
            $romanMonth = $this->toRoman((int) $currentDate->format('m'));
            $pattern = str_replace('#^MM', $romanMonth, $pattern);
        } else {
            $pattern = str_replace('#MM', $currentDate->format('m'), $pattern);
        }
        if (strpos($pattern, '#^DD') !== false) {
            $romanDay = $this->toRoman((int) $currentDate->format('d'));
            $pattern = str_replace('#^DD', $romanDay, $pattern);
        } else {
            $pattern = str_replace('#MM', $currentDate->format('d'), $pattern);
        }
        if (strpos($pattern, '#^YYYY') !== false) {
            $romanYear = $this->toRoman((int) $currentDate->format('Y'));
            $pattern = str_replace('#^YYYY', $romanYear, $pattern);
        } else {
            $pattern = str_replace('#YYYY', $currentDate->format('Y'), $pattern);
        }

        // Replace Roman numeral format (^)
        if (preg_match('/@\{\^\d+\}/', $pattern, $matches)) {
            $romanNumeralFormat = $matches[0];
            $digits = (int) filter_var($romanNumeralFormat, FILTER_SANITIZE_NUMBER_INT);
            $formattedNumber = $this->toRoman($number);
            $pattern = str_replace($romanNumeralFormat, $formattedNumber, $pattern);
        }

        // Remove single quotes
        $pattern = str_replace("'", '', $pattern);

        return $pattern;
    }
}
