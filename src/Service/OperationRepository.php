<?php
/**
 * RokPayment Service OperationRepository
 *
 * @package RokPayment\Service
 */

namespace RokPayment\Service;

/**
 * OperationRepository Class
 */
class OperationRepository
{

    /**
     * Operations
     *
     * @var array
     */
    protected $operations;

    /**
     *  set operations
     *
     * @param array of object operation
     *
     * @return void
     */
    public function add(Operation $operation)
    {
        $this->operations[] = $operation;
    }

    /**
     *  get all operations
     *
     * @return array
     */
    public function getAll(): array
    {
        return $this->operations;
    }

    /**
     * return users weekly operation
     *
     * @param int user_id
     * @param string date
     *
     * @return array
     */
    public function getUserCashOutFromSameWeek(int $user_id, string $date)
    {

        $operations = [];
        
        $current_date = new \DateTime($date);
        $current_week = $current_date->format('W');

        foreach ($this->operations as $operation) {
            $operation_date = new \DateTime($operation->getDate());
            $operation_week = $operation_date->format('W');

            if ($operation->getUserId() == $user_id && $operation->getOperationType() == Operation::WITHDRAW) {
                if ($current_week == $operation_week && abs($current_date->diff($operation_date)->format('%R%a')) <= 7) {
                    $operations[] = $operation;
                } elseif ($current_week < $operation_week) {
                    break;
                }
            }
        }

        return $operations;
    }
}
