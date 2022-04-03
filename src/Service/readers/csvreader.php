<?php
/**
 * RokPayment Service CurrencyConverter
 *
 * @package RokPayment\Service\readers
 */

namespace RokPayment\Service\readers;

/**
 * CsvReader Class
 */
class CsvReader
{

    /**
     *
     * @var file_path
     */
    private $file_path;

    /**
     *
     * @var delimeter
     */
    private $delimeter;

    /**
     *  Constructor
     */
    public function __construct(string $file_path, string $delimeter = '')
    {
        $this->file_path = $file_path;
        $this->delimeter = $delimeter;
    }

    /**
     * set file path
     *
     * @param string file_path
     *
     *
     * return void
     */
    public function setFilePath(string $file_path)
    {

        if (!file_exists($file_path)) {
            throw new \Exception('Wrong File path');
        }

        $this->file_path = $file_path;
    }

    /**
     * set delimeter
     *
     * @param string delimeter
     *
     *
     * return void
     */
    public function setDelimeter(string $delimeter)
    {
        $this->delimeter = $delimeter;
    }

    /**
     * get data
     *
     * return void
     */
    public function getData(): array
    {
        $results = [];
        $row = 0;
        
        if (( $handle = fopen($this->file_path, "r")) !== false) {
            while (( $data = fgetcsv($handle, 1000, $this->delimeter)) !== false) {
                $num = count($data);
                $row++;

                for ($c = 0; $c < $num; $c++) {
                    $results[$row][] = $data[$c];
                }
            }
            
            fclose($handle);
        }

        return $results;
    }
}
