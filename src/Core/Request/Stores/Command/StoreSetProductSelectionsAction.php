<?php

namespace Commercetools\Core\Request\Stores\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Stores\Command
 * @link https://docs.commercetools.com/api/projects/stores#set-product-selections
 *
 * @method string getAction()
 * @method StoreSetProductSelectionsAction setAction(string $action = null)
 * @method array getProductSelections()
 * @method StoreSetProductSelectionsAction setProductSelections(array $productSelections = null)
 */
class StoreSetProductSelectionsAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'productSelections' => [static::TYPE => 'array'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setProductSelections');
    }

    /**
     * @param array $productSelections
     * @param Context|callable $context
     * @return StoreSetProductSelectionsAction
     */
    public static function ofProductSelections(array $productSelections, $context = null)
    {
        return static::of($context)->setProductSelections($productSelections);
    }
}
