<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 04.02.15, 16:44
 */

namespace Sphere\Core\Model\Common;


/**
 * Class Money
 * @package Sphere\Core\Model\Common
 * @method static Money of(string $currencyCode, int $centAmount)
 * @method string getCurrencyCode()
 * @method int getCentAmount()
 * @method Money setCurrencyCode(string $currencyCode)
 * @method Money setCentAmount(int $centAmount)
 */
class Money extends JsonObject
{
    use OfTrait;

    public function getFields()
    {
        return [
            'currencyCode' => [self::TYPE => 'string'],
            'centAmount' => [self::TYPE => 'int'],
        ];
    }

    /**
     * @param string $currencyCode
     * @param int $centAmount
     */
    public function __construct($currencyCode, $centAmount, Context $context = null)
    {
        $this->setContext($context);
        $this->setCurrencyCode($currencyCode);
        $this->setCentAmount($centAmount);
    }

    /**
     * @param array $data
     * @return static
     */
    public static function fromArray(array $data, Context $context = null)
    {
        return new static(
            $data['currencyCode'],
            $data['centAmount'],
            $context
        );
    }
}
