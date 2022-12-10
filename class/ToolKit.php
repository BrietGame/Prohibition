<?php

class ToolKit
{
    public static function getJon($data)
    {
        $jsonFile = file_get_contents($data);
        return json_decode($jsonFile, true);
    }

    public static function randomSelector(array $array)
    {
        return $array[array_rand($array)];
    }
    public static function randomArraySelector(array $array)
    {
        return array_search($array[array_rand($array)], $array);
    }

    public static function randomUniqueSelector(array $array, int $nb): array
    {
        $newArray = [];
        for($i = 0; $i < $nb; $i++) {
            shuffle($array);
            $newArray[] = array_pop($array);
        }
        return $newArray;
    }




}