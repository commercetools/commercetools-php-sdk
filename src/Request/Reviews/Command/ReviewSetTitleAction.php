<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Reviews\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;

/**
 * Class ReviewSetTitleAction
 * @package Sphere\Core\Request\Reviews\Command
 * 
 * @method string getAction()
 * @method ReviewSetTitleAction setAction(string $action = null)
 * @method string getTitle()
 * @method ReviewSetTitleAction setTitle(string $title = null)
 */
class ReviewSetTitleAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'title' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setTitle');
    }
}
