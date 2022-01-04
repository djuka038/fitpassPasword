<?php

use PHPUnit\Framework\TestCase;
use FitPassPassword\Lib;

class PasswordAssertionTest extends TestCase
{

    protected $lib;

    protected function setUp(): void
    {
        $this->lib = new Lib();
    }

    public function testPasswordStrength1()
    {
        $randomPassword = $this->lib->generatePassword(8, 1);

        $this->assertGreaterThanOrEqual(2, preg_match_all("/[A-Z]/", $randomPassword));
        $this->assertGreaterThanOrEqual(1, preg_match_all("/[a-z]/", $randomPassword));
    }

    public function testPasswordStrength2()
    {
        $randomPassword = $this->lib->generatePassword(8, 2);

        $this->assertGreaterThanOrEqual(2, preg_match_all("/[A-Z]/", $randomPassword));
        $this->assertGreaterThanOrEqual(1, preg_match_all("/[a-z]/", $randomPassword));
        $this->assertGreaterThanOrEqual(1, preg_match_all("/[3-4]/", $randomPassword));
        $this->assertEquals(true, str_contains($randomPassword, "2"));
        $this->assertEquals(true, str_contains($randomPassword, "5"));
    }

    public function testPasswordStrength3()
    {
        $randomPassword = $this->lib->generatePassword(8, 3);
        $symbols = "!#$%&(){}[]=";

        $this->assertGreaterThanOrEqual(2, preg_match_all("/[A-Z]/", $randomPassword));
        $this->assertGreaterThanOrEqual(1, preg_match_all("/[a-z]/", $randomPassword));
        $this->assertGreaterThanOrEqual(1, preg_match_all("/[3-4]/", $randomPassword));
        $this->assertEquals(true, str_contains($randomPassword, "2"));
        $this->assertEquals(true, str_contains($randomPassword, "5"));
        $this->assertGreaterThanOrEqual(1,  strlen(strpbrk($randomPassword, $symbols)));
    }
}
