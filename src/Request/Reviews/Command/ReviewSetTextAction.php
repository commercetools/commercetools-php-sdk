<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Reviews\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;

/**
 * Class ReviewSetTextAction
 * @package Sphere\Core\Request\Reviews\Command
 * 
 * @method string getAction()
 * @method ReviewSetTextAction setAction(string $action = null)
 * @method string getText()
 * @method ReviewSetTextAction setText(string $text = null)
 */
class ReviewSetTextAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'text' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setText');
    }
}
