<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 04.02.15, 16:44
 */

namespace Sphere\Core\Model\Type;

/**
 * Class Money
 * @package Sphere\Core\Model\Type
 * @method static Money of(string $currencyCode, int $centAmount)
 */
class Money extends JsonObject
{
    /**
     * @var string
     */
    protected $currencyCode;

    /**
     * @var int
     */
    protected $centAmount;

    /**
     * @param string $currencyCode
     * @param int $centAmount
     */
    public function __construct($currencyCode, $centAmount)
    {
        $this->setCurrencyCode($currencyCode);
        $this->setCentAmount($centAmount);
    }


    /**
     * @return string
     */
    public function getCurrencyCode()
    {
        return $this->currencyCode;
    }

    /**
     * @param string $currencyCode
     * @return $this
     */
    public function setCurrencyCode($currencyCode)
    {
        $this->currencyCode = $currencyCode;

        return $this;
    }

    /**
     * @return int
     */
    public function getCentAmount()
    {
        return $this->centAmount;
    }

    /**
     * @param int $centAmount
     * @return $this
     */
    public function setCentAmount($centAmount)
    {
        $this->centAmount = $centAmount;

        return $this;
    }
}
