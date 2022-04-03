<?php
namespace RokPayment\Tests\Service;

use PHPUnit\Framework\TestCase;
use RokPayment\Service\CurrencyConverter;

class CurrencyConverterTest extends TestCase
{
    /**
     * @param float $amount
     * @param string $currency
     * @param int $expectation
     *
     * @dataProvider dataProviderForconvertToEur
     */
    public function testconvertToEur(float $amount, string $currency, int $expectation)
    {
        $this->assertEquals($expectation, CurrencyConverter::convertToEur($amount, $currency));
	}

    /**
     * @param float $amount
     * @param string $currency
     * @param int $expectation
     *
     * @dataProvider dataProviderForconvertToEur
     */
    public function testconvertEur(float $amount, string $currency, int $expectation)
    {
        $this->assertEquals($expectation, CurrencyConverter::convertToEur($amount, $currency));
	}

    public function dataProviderForconvertToEur(): array
    {
        return [
            'convert jpy to eur' => ['130.869977', 'JPY', 1],
        ];
    }

    public function dataProviderForconvertEur(): array
    {
        return [
            'convert jpy to eur' => [ 1, 'JPY', 130.869977 ],
        ];
    }
}
