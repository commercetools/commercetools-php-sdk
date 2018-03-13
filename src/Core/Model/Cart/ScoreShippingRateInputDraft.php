<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 27.01.15, 18:22
 */

namespace Commercetools\Core\Model\Cart;

use Commercetools\Core\Model\Common\Context;

/**
 * @package Commercetools\Core\Model\Cart
 * @link http://dev.commercetools.com/http-api-projects-carts.html#scoreshippingrateinputdraft
 * @method string getType()
 * @method ScoreShippingRateInputDraft setType(string $type = null)
 * @method int getScore()
 * @method ScoreShippingRateInputDraft setScore(int $score = null)
 */
class ScoreShippingRateInputDraft extends ShippingRateInputDraft
{
    public function fieldDefinitions()
    {
        return [
            'type' => [static::TYPE => 'string'],
            'score' => [static::TYPE => 'int'],
        ];
    }

    /**
     * @param int $score
     * @param Context|callable $context
     * @return ScoreShippingRateInputDraft
     */
    public static function ofScore($score, $context = null)
    {
        return static::ofType(ScoreShippingRateInput::INPUT_TYPE, $context)->setScore($score);
    }
}
