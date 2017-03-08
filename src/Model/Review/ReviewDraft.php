<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Review;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\State\StateReference;
use Commercetools\Core\Model\Common\ResourceIdentifier;
use Commercetools\Core\Model\Customer\CustomerReference;
use Commercetools\Core\Model\CustomField\CustomFieldObject;

/**
 * @package Commercetools\Core\Model\Review
 * @link https://dev.commercetools.com/http-api-projects-reviews.html#reviewdraft
 * @method string getKey()
 * @method ReviewDraft setKey(string $key = null)
 * @method string getUniquenessValue()
 * @method ReviewDraft setUniquenessValue(string $uniquenessValue = null)
 * @method string getLocale()
 * @method ReviewDraft setLocale(string $locale = null)
 * @method string getAuthorName()
 * @method ReviewDraft setAuthorName(string $authorName = null)
 * @method string getTitle()
 * @method ReviewDraft setTitle(string $title = null)
 * @method string getText()
 * @method ReviewDraft setText(string $text = null)
 * @method ResourceIdentifier getTarget()
 * @method ReviewDraft setTarget(ResourceIdentifier $target = null)
 * @method StateReference getState()
 * @method ReviewDraft setState(StateReference $state = null)
 * @method int getRating()
 * @method ReviewDraft setRating(int $rating = null)
 * @method CustomerReference getCustomer()
 * @method ReviewDraft setCustomer(CustomerReference $customer = null)
 * @method CustomFieldObject getCustom()
 * @method ReviewDraft setCustom(CustomFieldObject $custom = null)
 */
class ReviewDraft extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'key' => [static::TYPE => 'string'],
            'uniquenessValue' => [static::TYPE => 'string'],
            'locale' => [static::TYPE => 'string'],
            'authorName' => [static::TYPE => 'string'],
            'title' => [static::TYPE => 'string'],
            'text' => [static::TYPE => 'string'],
            'target' => [static::TYPE => ResourceIdentifier::class],
            'state' => [static::TYPE => StateReference::class],
            'rating' => [static::TYPE => 'int'],
            'customer' => [static::TYPE => CustomerReference::class],
            'custom' => [static::TYPE => CustomFieldObject::class],
        ];
    }

    /**
     * @param string $title
     * @param Context|callable $context
     * @return ReviewDraft
     */
    public static function ofTitle($title, $context = null)
    {
        return static::of($context)->setTitle($title);
    }

    /**
     * @param string $text
     * @param Context|callable $context
     * @return ReviewDraft
     */
    public static function ofText($text, $context = null)
    {
        return static::of($context)->setText($text);
    }

    /**
     * @param int $rating
     * @param Context|callable $context
     * @return ReviewDraft
     */
    public static function ofRating($rating, $context = null)
    {
        return static::of($context)->setRating($rating);
    }

    public function jsonSerialize()
    {
        $data = parent::jsonSerialize();
        if (isset($data['locale'])) {
            $data['locale'] = str_replace('_', '-', $data['locale']);
        }
        return $data;
    }
}
