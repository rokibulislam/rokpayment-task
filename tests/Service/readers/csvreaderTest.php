<?php
namespace RokPayment\Tests\Service\readers;

use PHPUnit\Framework\TestCase;
use RokPayment\Service\readers\CsvReader;

class CsvReaderTest extends TestCase
{
    /**
     * @param string $file_path
     * @param string $delimeter
     * @param int $expectation
     *
     * @dataProvider dataProviderForgetData
     */
    public function testgetData($file_path, $delimeter, $expectation)
    {
        $csvReader = new CsvReader($file_path, $delimeter);
        $data = $csvReader->getData();

        $this->assertEquals($expectation, count($data));
    }

    public function dataProviderForgetData(): array
    {
        return [
            'get data from csv' => [ 'input.csv', ',' , 13 ],
        ];
    }
}
