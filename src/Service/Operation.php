<?php
/**
 * RokPayment Service Operation
 *
 * @package RokPayment\Service
 */

namespace RokPayment\Service;

/**
 * Operation Class
 */
class Operation
{
    /**
     * Operation id
     *
     * @var int
     */
    private $id;

    /**
     * Operation date
     *
     * @var string
     */
    private $date;

    /**
     * Operation user Id
     *
     * @var int
     */
    private $user_id;

    /**
     * Operation user Type
     *
     * @var string
     */
    private $user_type;

    /**
     * Operation Type
     *
     * @var string
     */
    private $operation_type;

    /**
     * Operation Amount
     *
     * @var float
     */
    private $amount;

    /**
     * Operation Currency
     *
     * @var string
     */
    private $currency;
  
    const WITHDRAW = 'withdraw';
    const DEPOSIT = 'deposit';

    /**
     * Set Id
     *
     * @param string id
     *
     * @return void
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * Get Id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set Id
     *
     * @param string date
     *
     * @return void
     */
    public function setDate(string $date)
    {
        $this->date = $date;
    }

    /**
     * Set Id
     *
     * @return void
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * Set Id
     *
     * @param string user_id
     *
     * @return void
     */
    public function setUserId(int $user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * Set Id
     *
     * @return void
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * Set User Type
     *
     * @param string user_type
     *
     * @return void
     */
    public function setUserType(string $user_type)
    {
        $this->user_type = $user_type;
    }

    /**
     * Set User Type
     *
     * @return string
     */
    public function getUserType(): string
    {
        return $this->user_type;
    }

    /**
     * Set Operation Type
     *
     * @param string operation_type
     *
     * @return void
     */
    public function setOperationType(string $operation_type)
    {
        $this->operation_type = $operation_type;
    }

    /**
     * Get Operation Type
     *
     * @return string
     */
    public function getOperationType(): string
    {
        return $this->operation_type;
    }

    /**
     * Set Amount
     *
     * @param string amount
     *
     * @return void
     */
    public function setAmount(string $amount)
    {
        $this->amount = $amount;
    }

    /**
     * Get Amount
     *
     * @return string
     */
    public function getAmount(): string
    {
        return $this->amount;
    }

    /**
     * Set Currency
     *
     * @param string curreny
     *
     * @return void
     */
    public function setCurrency(string $currency)
    {
        $this->currency = $currency;
    }

    /**
     * Get Currency
     *
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }
}
