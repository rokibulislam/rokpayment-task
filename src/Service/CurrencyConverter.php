<?php
/**
 * RokPayment Service CurrencyConverter
 *
 * @package RokPayment\Service
 */

namespace RokPayment\Service;

/**
 * CurrencyConverter Class
 */
class CurrencyConverter
{
    
    /**
     * EUR_CONVERSION rates
     *
     * @var EUR CONVERSION
     */
    const EUR_CONVERSION = [
        'EUR' => 1,
        'USD' => 1.129031,
        'JPY' => 130.869977,
    ];

    /**
     *
     * @param amount float
     * @param currency string
     *
     * @return float
     */
    public static function convertEur(float $amount, string $currency): float
    {
        $result = $amount * self::EUR_CONVERSION[$currency];

        return (float) $result;
    }

    /**
     *
     * @param amount float
     * @param currency string
     *
     * @return float
     */
    public static function convertToEur(float $amount, string $currency): float
    {
        $result = $amount / self::EUR_CONVERSION[$currency];

        return (float) $result;
    }
}
