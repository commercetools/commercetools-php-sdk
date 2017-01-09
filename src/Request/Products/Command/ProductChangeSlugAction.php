<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Products\Command
 * @link https://dev.commercetools.com/http-api-projects-products.html#change-slug
 * @method string getAction()
 * @method ProductChangeSlugAction setAction(string $action = null)
 * @method LocalizedString getSlug()
 * @method ProductChangeSlugAction setSlug(LocalizedString $slug = null)
 * @method bool getStaged()
 * @method ProductChangeSlugAction setStaged(bool $staged = null)
 */
class ProductChangeSlugAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'slug' => [static::TYPE => LocalizedString::class],
            'staged' => [static::TYPE => 'bool'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeSlug');
    }

    /**
     * @param LocalizedString $slug
     * @param Context|callable $context
     * @return ProductChangeSlugAction
     */
    public static function ofSlug(LocalizedString $slug, $context = null)
    {
        return static::of($context)->setSlug($slug);
    }
}
