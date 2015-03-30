<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Helper\State\Renderer;


use Sphere\Core\Model\State\State;

class NodeRenderer
{
    const COMMAND_COLOR = '#555555';

    /**
     * @param State $state
     * @return string
     */
    public function render(State $state)
    {
        $graph = '';
        $color = static::COMMAND_COLOR;

        $graph .= '  node [label=' . $state->getKey() . ',color="",fontcolor="' . $color . '"' .
            ',style="",shape="plaintext",fontname="Arial"] ' .
            '{ state_' . $state->getKey()  . ' } ' . PHP_EOL;

        return $graph;
    }
}
