<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Types\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\Common\LocalizedString;

/**
 * @package Commercetools\Core\Request\Types\Command
 * @method string getAction()
 * @method TypeChangeDescriptionAction setAction(string $action = null)
 * @method LocalizedString getDescription()
 * @method TypeChangeDescriptionAction setDescription(LocalizedString $description = null)
 */
class TypeChangeDescriptionAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'description' => [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeDescription');
    }

    /**
     * @param string $description
     * @param Context|callable $context
     * @return TypeChangeDescriptionAction
     */
    public static function ofDescription($description, $context = null)
    {
        return static::of($context)->setDescription($description);
    }
}
