<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Helper\State\Renderer;

use Commercetools\Core\Model\State\State;

class TransitionRenderer
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

        foreach ($state->getTransitions() as $transition) {
            /**
             * @var State $targetState
             */
            $targetState = $transition->getObj();
            if ($targetState->getKey() === $state->getKey()) {
                $graph .= '  edge[dir="back",style="solid",color="' . $color . '"] state_'
                    . $state->getKey() . ' -> state_' . $state->getKey()  . ';' . PHP_EOL;
            } else {
                $graph .= '  edge[dir="forward",style="solid",color="' . $color . '"] state_'
                    . $state->getKey() . ' -> state_' . $targetState->getKey() . ' ;' . PHP_EOL;
            }
        }

        return $graph;
    }
}
