<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Comments\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;

/**
 * Class CommentSetTitleAction
 * @package Sphere\Core\Request\Comments\Command
 * 
 * @method string getAction()
 * @method CommentSetTitleAction setAction(string $action = null)
 * @method string getTitle()
 * @method CommentSetTitleAction setTitle(string $title = null)
 */
class CommentSetTitleAction extends AbstractAction
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
