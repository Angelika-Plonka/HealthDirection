<?php

namespace App\Calculator;

class BmiCalculator
{

    /**
     * @param array $parameters
     * @return float
     */
    public static function getBmi(array $parameters): ?float
    {

        if (!$parameters['weight'] || !$parameters['height'] || 0 == $parameters['height']) {
            return 0;
        }

        return round($parameters['weight'] / pow($parameters['height'] / 100, 2), 2);
    }

}
