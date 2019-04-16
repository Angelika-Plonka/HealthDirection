<?php

namespace App\Model;

use App\Entity\Fitness;
use App\Calculator\BmiCalculator;

class FitnessCalculators
{

    private function __construct()
    {

    }

    public static function updateAllCalculations(Fitness $fitness)
    {
        self::updateBmi($fitness);
    }

    public static function updateBmi(Fitness $fitness)
    {
        try {
            $bmi = BmiCalculator::getBmi([
                    'weight' => $fitness->getWeight(),
                    'height' => $fitness->getHeight(),
            ]);
        } catch (\Exception $ex) {
            $bmi = null;
        }

        $fitness->setBmi($bmi);
    }

}
