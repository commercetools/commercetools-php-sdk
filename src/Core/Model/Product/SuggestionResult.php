<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Product;

use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\Product
 *
 * @method LocalizedSuggestionCollection getSearchKeywords()
 * @method SuggestionResult setSearchKeywords(LocalizedSuggestionCollection $searchKeywords = null)
 */
class SuggestionResult extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'searchKeywords' => [static::TYPE => LocalizedSuggestionCollection::class]
        ];
    }

    public static function fromArray(array $data, $context = null)
    {
        $result = [];
        foreach ($data as $key => $value) {
            $parts = explode('.', $key, 2);
            if ($parts[0] == 'searchKeywords') {
                $result['searchKeywords'][$parts[1]] = $value;
            } else {
                $result[$key] = $value;
            }
        }

        return parent::fromArray($result, $context);
    }

    public function toArray()
    {
        $data = parent::toArray();
        
        if (isset($data['searchKeywords']) && is_array($data['searchKeywords'])) {
            foreach ($data['searchKeywords'] as $locale => $keywords) {
                $data['searchKeywords.' . $locale] = $keywords;
            }
            unset($data['searchKeywords']);
        }

        return $data;
    }
}
