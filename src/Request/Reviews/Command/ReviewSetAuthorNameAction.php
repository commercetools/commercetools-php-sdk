<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Reviews\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;

/**
 * @package Sphere\Core\Request\Reviews\Command
 * 
 * @method string getAction()
 * @method ReviewSetAuthorNameAction setAction(string $action = null)
 * @method string getAuthorName()
 * @method ReviewSetAuthorNameAction setAuthorName(string $authorName = null)
 */
class ReviewSetAuthorNameAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'authorName' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setAuthorName');
    }
}
