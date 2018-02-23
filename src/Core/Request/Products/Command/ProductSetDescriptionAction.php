<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Products\Command
 * @link https://docs.commercetools.com/http-api-projects-products.html#set-description
 * @method string getAction()
 * @method ProductSetDescriptionAction setAction(string $action = null)
 * @method LocalizedString getDescription()
 * @method ProductSetDescriptionAction setDescription(LocalizedString $description = null)
 * @method bool getStaged()
 * @method ProductSetDescriptionAction setStaged(bool $staged = null)
 */
class ProductSetDescriptionAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'description' => [static::TYPE => LocalizedString::class],
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
        $this->setAction('setDescription');
    }

    /**
     * @param LocalizedString $description
     * @param Context|callable $context
     * @return ProductSetDescriptionAction
     */
    public static function ofDescription(LocalizedString $description, $context = null)
    {
        return static::of($context)->setDescription($description);
    }
}
