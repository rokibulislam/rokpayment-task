<?php
/**
 * RokPayment Service Deposit
 *
 * @package RokPayment\Service\commissions
 */

namespace RokPayment\Service\commissions;

use RokPayment\Service\commissions\CommissionStrategy;
use RokPayment\Service\Operation;

/**
 * Deposit Class
 */ 
class Deposit extends CommissionStrategy
{
	/**
     * Commission Percent
     *
     * @var COMMISSION_PERCENT
     */
	const COMMISSION_PERCENT = 0.03;
	
	/**
	 * calculate Deposit Commission
	 *
	 * @return float
	 */
	public function calculate() : float
	{
		$commission = $this->operation->getAmount() * self::COMMISSION_PERCENT / 100;

		return $commission;
	}
}
