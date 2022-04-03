<?php
/**
 * RokPayment Service Commissions
 *
 * @package RokPayment\Service\commissions
 */

namespace RokPayment\Service\commissions;

use RokPayment\Service\OperationRepository;
use RokPayment\Service\Operation;
use RokPayment\Service\commissions\Deposit;
use RokPayment\Service\commissions\Withdraw;

/**
 * CommissionCalculator Class
 */
class CommissionCalculator
{

    /**
     *
     * @var operations
     */
    protected $operations;

    /**
     *
     * @var repository
     */
    protected $repository;


    /**
     * constructor
     */
    public function __construct(OperationRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * set CommissionStrategy object
     *
     * @return CommissionStrategy object
     */
    protected function getStrategy(Operation $operation): CommissionStrategy
    {
        switch ($operation->getOperationType()) {
            case Operation::DEPOSIT:
                $strategy = new Deposit($operation);
                break;
            
            case Operation::WITHDRAW:
                $strategy = new Withdraw($operation, $this->repository);
                break;
            
            default:
                throw new \Exception("Unknown strategy: " . $operation_name);
                break;
        }

        return $strategy;
    }

    /**
     * calculate commissions
     *
     * @return array
     */
    public function calculate(): array
    {
        $results = [];

        foreach ($this->repository->getAll() as $operation) {
            $calculator = $this->getStrategy($operation);
            $results[] = $this->format($calculator->calculate());
        }

        return $results;
    }

    /**
     * formatting  commission
     *
     * @return string
     */
    protected function format($result): string
    {
        $rounded = ceil($result * 100) / 100;
        $formatted_result = number_format((float) $rounded, 2, '.', '');

        return $formatted_result;
    }
}
