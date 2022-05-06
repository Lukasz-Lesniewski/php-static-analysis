<?php

declare(strict_types=1);

namespace App\Tests;

use App\Example;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * @test
     */
    public function shouldGiveNothing(): void {
        $change = Example::run([50, 20, 20, 5], 'A');

        $this->assertEquals([50 => 0, 20 => 0, 10 => 0, 5 => 0, 2 => 0, 1 => 0], $change);
    }

    /**
     * @test
     */
    //public function shouldGiveCoins(): void {
    //    $change = Example::run([50, 50, 20, 20], 'A');
    //
    //    $this->assertEquals([50 => 0, 20 => 2, 10 => 0, 5 => 1, 2 => 0, 1 => 0], $change);
    //}
}
