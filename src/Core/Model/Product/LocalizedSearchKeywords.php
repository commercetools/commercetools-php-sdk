<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Product;

use Commercetools\Core\Error\InvalidArgumentException;
use Commercetools\Core\Error\Message;
use Commercetools\Core\Model\Common\Collection;
use Commercetools\Core\Model\Common\Context;

/**
 * @package Commercetools\Core\Model\Product
 * @link https://docs.commercetools.com/http-api-projects-products.html#searchkeywords
 * @method SearchKeywords current()
 * @method SearchKeywords getAt($offset)
 */
class LocalizedSearchKeywords extends Collection
{
    const COLLECTION_TYPE = Collection::TYPE_MAP;

    protected $type = SearchKeywords::class;

    /**
     * @param $locale
     * @return SearchKeywords
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
     * @return SearchKeywords
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
            return new SearchKeywords();
        }
        return $this->getAt($locale);
    }

    /**
     * @param $object
     * @return $this
     * @internal
     */
    public function add($object)
    {
        return parent::add($object);
    }

    public function __toString()
    {
        return (string)$this->get();
    }
}
