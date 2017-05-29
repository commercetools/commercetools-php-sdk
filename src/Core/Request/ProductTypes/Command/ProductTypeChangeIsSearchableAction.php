<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ProductTypes\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\ProductTypes\Command
 * @link https://dev.commercetools.com/http-api-projects-productTypes.html#change-attributedefinition-issearchable
 * @method string getAction()
 * @method ProductTypeChangeIsSearchableAction setAction(string $action = null)
 * @method string getAttributeName()
 * @method ProductTypeChangeIsSearchableAction setAttributeName(string $attributeName = null)
 * @method bool getIsSearchable()
 * @method ProductTypeChangeIsSearchableAction setIsSearchable(bool $isSearchable = null)
 */
class ProductTypeChangeIsSearchableAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'attributeName' => [static::TYPE => 'string'],
            'isSearchable' => [static::TYPE => 'bool']
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeIsSearchable');
    }

    /**
     * @param string $attributeName
     * @param bool $isSearchable
     * @param Context|callable $context
     * @return ProductTypeChangeIsSearchableAction
     */
    public static function ofAttributeNameAndIsSearchable($attributeName, $isSearchable, $context = null)
    {
        return static::of($context)->setAttributeName($attributeName)->setIsSearchable($isSearchable);
    }
}
