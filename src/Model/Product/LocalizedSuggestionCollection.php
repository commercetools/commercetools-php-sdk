<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Product;

use Commercetools\Core\Error\InvalidArgumentException;
use Commercetools\Core\Error\Message;
use Commercetools\Core\Model\Common\Collection;
use Commercetools\Core\Model\Common\Context;

/**
 * @package Commercetools\Core\Model\Product
 * @link https://dev.commercetools.com/http-api-projects-products-search.html#representations
 * @method SuggestionCollection current()
 * @method LocalizedSuggestionCollection add(SuggestionCollection $element)
 * @method SuggestionCollection getAt($offset)
 */
class LocalizedSuggestionCollection extends Collection
{
    protected $type = '\Commercetools\Core\Model\Product\SuggestionCollection';

    /**
     * @param $locale
     * @return SuggestionCollection
     */
    public function __get($locale)
    {
        $context = new Context();
        $context->setGraceful($this->getContext()->isGraceful())
            ->setLanguages([$locale]);
        return $this->get($context);
    }

    /**
     * @param Context $context
     * @return string
     */
    protected function getLanguage(Context $context)
    {
        $locale = null;
        foreach ($context->getLanguages() as $language) {
            if (isset($this[$language])) {
                $locale = $language;
                break;
            }
        }
        return $locale;
    }

    /**
     * @param Context $context
     * @return SuggestionCollection
     */
    public function get(Context $context = null)
    {
        if (is_null($context)) {
            $context = $this->getContext();
        }
        $locale = $this->getLanguage($context);
        if (!isset($this[$locale])) {
            if (!$context->isGraceful()) {
                throw new InvalidArgumentException(Message::NO_VALUE_FOR_LOCALE);
            }
            return new SuggestionCollection();
        }
        return $this->getAt($locale);
    }
}
