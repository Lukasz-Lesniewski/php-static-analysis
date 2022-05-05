<?php

declare(strict_types=1);

namespace App;

use RuntimeException;

class Example
{
    public static function run(array $insertedCoins, string $selectedProduct): array
    {
        $products = ['A' => 95];

        return self::change(
            !isset($products[$selectedProduct])
                ? throw new RuntimeException('Unknown product')
                : array_sum(
                    array_filter($insertedCoins, static function ($coin) {
                        return match ($coin) {
                            1, 2, 5, 10, 20, 50 => true,
                            default => false,
                        };
                    })
                ) - $products[$selectedProduct],
            [50 => 0, 20 => 0, 10 => 0, 5 => 0, 2 => 0, 1 => 0],
            [50, 20, 10, 5, 2, 1]
        );
    }

    private static function change(int $amount, array $change, array $availableCoins): array
    {
        if ($amount < 0) {
            throw new RuntimeException('Not enough coins entered');
        }

        if (empty($availableCoins)) {
            return $change;
        }

        $coin = array_shift($availableCoins);
        $change[$coin] = (int)floor($amount / $coin);
        $restFromAmount = $amount % $coin;

        return self::change($restFromAmount, $change, $availableCoins);
    }
}
