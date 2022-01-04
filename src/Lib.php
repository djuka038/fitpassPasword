<?php

namespace FitPassPassword;

class Lib
{

    /**
     * Generate random password
     *
     * @param integer $length
     * @param integer $strength
     * @return mixed
     */
    public static function generatePassword(int $length, int $strength): mixed
    {
        if ($length < 6) {
            return false;
        }

        $capitalLetters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $smallLetters = "abcdefghijklmnopqrstuvwxyz";
        $numbers = "0123456789";
        $symbols = "!#$%&(){}[]=";
        $randomString = "";

        if ($strength === 1) {
            $characters = $capitalLetters . $smallLetters;
            $numberOfValidCharacters = strlen($characters);

            do {
                $randomString = "";
                for ($i = 0; $i < $length; $i++)
                {
                    $randomPick = mt_rand(1, $numberOfValidCharacters);
                    $randomChar = $characters[$randomPick-1];
                    $randomString .= $randomChar;
                }
            } while(
                preg_match_all("/[A-Z]/", $randomString) < 2
                || preg_match_all("/[a-z]/", $randomString) < 1
            );
        }

        if ($strength === 2) {
            $characters = $capitalLetters . $smallLetters . $numbers;
            $numberOfValidCharacters = strlen($characters);

            do {
                $randomString = "";
                for ($i = 0; $i < $length; $i++)
                {
                    $randomPick = mt_rand(1, $numberOfValidCharacters);
                    $randomChar = $characters[$randomPick-1];
                    $randomString .= $randomChar;
                }
            } while(
                preg_match_all("/[A-Z]/", $randomString) < 2
                || preg_match_all("/[a-z]/", $randomString) < 1
                || preg_match_all("/[3-4]/", $randomString) < 1
                || str_contains($randomString, "2") !== true
                || str_contains($randomString, "5") !== true
            );
        }

        if ($strength === 3) {
            $characters = $capitalLetters . $smallLetters . $numbers . $symbols;
            $numberOfValidCharacters = strlen($characters);

            do {
                $randomString = "";
                for ($i = 0; $i < $length; $i++)
                {
                    $randomPick = mt_rand(1, $numberOfValidCharacters);
                    $randomChar = $characters[$randomPick-1];
                    $randomString .= $randomChar;
                }
            } while(
                preg_match_all("/[A-Z]/", $randomString) < 2
                || preg_match_all("/[a-z]/", $randomString) < 1
                || preg_match_all("/[3-4]/", $randomString) < 1
                || str_contains($randomString, "2") !== true
                || str_contains($randomString, "5") !== true
                || strlen(strpbrk($randomString, $symbols)) < 1
            );
        }

        return $randomString;
    }
}
