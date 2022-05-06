<?php

declare(strict_types=1);

namespace App;

use RuntimeException;

class Example
{
    public static function run(array $insertedCoins, string $selectedProduct): array
    {
        $products = ['A' => 95];

        if (!isset($products[$selectedProduct])) {
            throw new RuntimeException('Unknown product');
        }

        $amount = array_sum(array_filter($insertedCoins, static fn ($coin) => match ($coin) {
            1, 2, 5, 10, 20, 50 => true,
        }));

        if ($amount < $products[$selectedProduct]) {
            throw new RuntimeException('Not enough coins entered');
        }

        return self::giveChangeInCoins(
            changeInCents: $amount - $products[$selectedProduct],
            changeInCoins: [50 => 0, 20 => 0, 10 => 0, 5 => 0, 2 => 0, 1 => 0],
            availableCoins: [50, 20, 10, 5, 2, 1]
        );
    }

    private static function giveChangeInCoins(int $changeInCents, array $changeInCoins, array $availableCoins): array
    {
        if (empty($availableCoins)) {
            return $changeInCoins;
        }

        $biggestCoin = array_shift($availableCoins);
        $changeInCoins[$biggestCoin] = (int)floor($changeInCents / $biggestCoin);
        $reducedCents = $changeInCents % $biggestCoin;

        return self::giveChangeInCoins($reducedCents, $changeInCoins, $availableCoins);
    }
}
