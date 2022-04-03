<?php
namespace RokPayment\Tests\Service\commissions;

use PHPUnit\Framework\TestCase;
use RokPayment\Service\commissions\Withdraw;
use RokPayment\Service\Operation;
use RokPayment\Service\OperationRepository;

class WithdrawTest extends TestCase
{
	private $withdraw;
	
	public function setUp()
	{
		$repository = new OperationRepository();
		$operation = new Operation();
		$operation->setId(1);
		$operation->setDate('2014-12-31');
		$operation->setUserId(4);
		$operation->setUserType('private');
		$operation->setOperationType('withdraw');
		$operation->setAmount(1200.00);
		$operation->setCurrency('EUR');

		$repository->add($operation);

		$this->withdraw = new Withdraw($operation, $repository);
	}

	/**
     * @param float $expectation
     *
     * @dataProvider dataProviderForTestCalculate
     */
	public function testCalculate($expectation)
	{
	 	$this->assertEquals($expectation, $this->withdraw->calculate());
	}

	public function dataProviderForTestCalculate(): array
    {
        return [
            'withdraw money' => [ 0.60 ],
        ];
    }
}
