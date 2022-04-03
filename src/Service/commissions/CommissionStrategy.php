<?php
/**
 * RokPayment Service CommissionStrategy
 *
 * @package RokPayment\Service\commissions
 */

namespace RokPayment\Service\commissions;

use RokPayment\Service\Operation;

/**
 *  CommissionStrategy class
 */
abstract class CommissionStrategy
{
    /**
     * store operation object
     *
     * @var operation
     */
    protected $operation;


    /**
     * constructor
     *
     */
    public function __construct(Operation $operation)
    {
        $this->operation = $operation;
    }

    abstract public function calculate();
}
