<?php

namespace App\Service;

class ToolsProvider {

    /**
     * Return key from flipped array
     *
     * @param string $key
     * @param array $array
     * @return string
     */
    public static function getKeyFromFlippedArray($key, array $array): string
    {
        $flippedArray = array_flip($array);
        if (!isset($flippedArray[$key])) {
            return $key;
        }

        return $flippedArray[$key];
    }

}
