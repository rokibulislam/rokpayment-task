<?php
/**
 * RokPayment Service Withdraw
 *
 * @package RokPayment\Service\commissions
 */
namespace RokPayment\Service\commissions;

use RokPayment\Service\commissions\CommissionStrategy;
use RokPayment\Service\Operation;
use RokPayment\Service\OperationRepository;
use RokPayment\Service\CurrencyConverter;

/**
 * WithDraw Class
 */
class Withdraw extends CommissionStrategy
{
    /**
     * Commission Private
     *
     * @var COMMISSION_PRIVATE
     */
    const COMMISSION_PRIVATE = 0.3;

    /**
     * Commission Bussiness
     *
     * @var COMMISSION_BUSSINESS
     */
    const COMMISSION_BUSSINESS = 0.50;

    /**
     * Times Per Week
     *
     * @var TIMES_PER_WEEK
     */
    const TIMES_PER_WEEK = 3;

    /**
     * Amount Per Week
     *
     * @var AMOUNT_PER_WEEK
     */
    const AMOUNT_PER_WEEK = 1000;

    /**
     *
     * @var repository
     */
    private $repository;


    /**
     *  constructor
     */
    public function __construct(Operation $operation, OperationRepository $repository)
    {
        parent::__construct($operation);
        
        $this->repository = $repository;
    }


    /**
     * calculate
     *
     * @return float
     */
    public function calculate(): float
    {
        $user_type = $this->operation->getUserType();

        if ($user_type == 'private') {
            $commission = $this->calculateForPrivateOperation();
        } elseif ($user_type == 'business') {
            $commission = $this->calculateForBussinessOperation();
        }

        return (float) $commission;
    }

    /**
     * calculate for bussiness operation
     *
     * @return float
     */
    public function calculateForBussinessOperation(): float
    {
        $commission = $this->operation->getAmount() * self::COMMISSION_BUSSINESS / 100;

        return $commission;
    }

    /**
     * calculate for private operation
     *
     * @return float
     */
    public function calculateForPrivateOperation(): float
    {
        $id = $this->operation->getId();
        $user_id = $this->operation->getUserId();
        $current_date = $this->operation->getDate();
        $current_amount = CurrencyConverter::convertToEur($this->operation->getAmount(), $this->operation->getCurrency());
        $user_operations =  $this->repository->getUserCashOutFromSameWeek($user_id, $current_date);
        $times_per_week = 0;
        $amount_per_week = 0;

        foreach ($user_operations as $operation) {
            $times_per_week++;

            if ($times_per_week <= self::TIMES_PER_WEEK) {
                $amount_per_week += CurrencyConverter::convertToEur($operation->getAmount(), $operation->getCurrency());
            }
            
            if ($amount_per_week >= self::AMOUNT_PER_WEEK) {
                $discount_id = $operation->getId();
                break;
            }
        }

        if (!empty($discount_id)) {
            if ($id == $discount_id) {
                $current_amount = $amount_per_week - self::AMOUNT_PER_WEEK;
            } elseif ($id < $discount_id) {
                $current_amount = 0;
            }
        } else {
            $current_amount = 0;
        }

        $commission = $current_amount * self::COMMISSION_PRIVATE / 100;
        $converted = CurrencyConverter::convertEur($commission, $this->operation->getCurrency());

        return $converted;
    }
}
