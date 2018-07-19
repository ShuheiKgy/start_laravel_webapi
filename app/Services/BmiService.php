<?php
/**
 * Created by PhpStorm.
 * User: shuhei-k
 * Date: 2018/07/17
 * Time: 22:31
 */

namespace App\Services;


use App\Models\Person;

class BmiService
{
    public static function getBmi(Person $person)
    {
        return self::calcBmi($person->height, $person->weight);
    }

    private static function calcBmi(float $height, float $weight)
    {
        if ($height > 0 && $weight > 0) {
            return $weight / $height / $height;
        } else {
            return false;
        }

    }

}