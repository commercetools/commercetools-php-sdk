<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 27.01.15, 18:22
 */

namespace Commercetools\Core\Model\Cart;

use Commercetools\Core\Model\Common\Context;

/**
 * @package Commercetools\Core\Model\Cart
 * @link http://dev.commercetools.com/http-api-projects-carts.html#scoreshippingrateinput
 * @method string getType()
 * @method ScoreShippingRateInput setType(string $type = null)
 * @method float getScore()
 * @method ScoreShippingRateInput setScore(float $score = null)
 */
class ScoreShippingRateInput extends ShippingRateInput
{
    const INPUT_TYPE = 'Score';

    public function fieldDefinitions()
    {
        return [
            'type' => [static::TYPE => 'string'],
            'score' => [static::TYPE => 'float'],
        ];
    }

    /**
     * @param $score
     * @param Context|callable $context
     * @return ScoreShippingRateInput
     */
    public static function ofScore($score, $context = null)
    {
        return static::ofType(static::INPUT_TYPE, $context)->setScore($score);
    }
}
