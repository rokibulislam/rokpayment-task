<?php
namespace RokPayment\Tests\Service\commissions;

use PHPUnit\Framework\TestCase;
use RokPayment\Service\commissions\Deposit;
use RokPayment\Service\Operation;

class DepositTest extends TestCase
{
	private $deposit;

	public function setUp()
	{
		$operation = new Operation();
		$operation->setId(1);
	    $operation->setDate('2014-12-31');
	    $operation->setUserId(4);
	    $operation->setUserType('private');
	    $operation->setOperationType('deposit');
	    $operation->setAmount(200.00);
	    $operation->setCurrency('EUR');

		$this->deposit = new Deposit($operation);
	}

	/**
     * @param float $expectation
     *
     * @dataProvider dataProviderForTestCalculate
     */
	public function testCalculate($expectation)
	{
		$this->assertEquals($expectation, $this->deposit->calculate());
	}

	public function dataProviderForTestCalculate(): array
	{
        return [
            'deposit money' => [ 0.06 ],
        ];
    }
}
