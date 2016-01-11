<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Helper\State;

use Commercetools\Core\Client;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Helper\State\Renderer\NodeRenderer;
use Commercetools\Core\Helper\State\Renderer\TransitionRenderer;
use Commercetools\Core\Model\State\StateCollection;
use Commercetools\Core\Request\States\StateQueryRequest;

class Renderer
{
    /** @var array Colors for drawing dwh states */
    public static $colors = array(
        '#2266aa',
        '#228866',
        '#775533',
        '#333311',
        '#881122',
        '#662266',
        '#00212E',
        '#42002E',
        '#422100',
        '#000B11',
        '#5A0011',
        '#5A0B00'
    );

    /** @var array $eventColors colors for drawing the events */
    protected $eventColors = array(
        'manual'  => '#00AA00',     // color for manually executable event
        'timeout' => '#AAAAAA',     // color for timeout event
        'statewasset' => '#0000AA',     // color for other events
        'default' => '#222222',     // color for other events
    );

    /** @var string $defaultFontColor default font color for state nodes */
    protected $defaultFontColor = '';
    /** @var string $defaultBorderColor default border color for state nodes */
    protected $defaultBorderColor = '';

    /**
     * @var array $nodeRenderers contains the renderers for the state nodes.
     *
     * They can be set by setNodeRendererByStateName(). If no renderer is set the default renderer
     * Bob_StateMachine_Renderer_Node_DefaultRenderer will be used.
     */
    protected $nodeRenderers = array();

    protected $transitionRenderers = array();

    /**
     * @return array
     */
    public function getEventColors()
    {
        return $this->eventColors;
    }

    /**
     * @param array $eventColors
     */
    public function setEventColors($eventColors)
    {
        $this->eventColors = $eventColors;
    }

    /**
     * @return string
     */
    public function getDefaultFontColor()
    {
        return $this->defaultFontColor;
    }

    /**
     * @param string $defaultFontColor
     */
    public function setDefaultFontColor($defaultFontColor)
    {
        $this->defaultFontColor = $defaultFontColor;
    }

    /**
     * @return string
     */
    public function getDefaultBorderColor()
    {
        return $this->defaultBorderColor;
    }

    /**
     * @param string $defaultBorderColor
     */
    public function setDefaultBorderColor($defaultBorderColor)
    {
        $this->defaultBorderColor = $defaultBorderColor;
    }

    /**
     * @return array
     */
    public function getNodeRenderers()
    {
        return $this->nodeRenderers;
    }

    /**
     * @param array $nodeRenderers
     */
    public function setNodeRenderers($nodeRenderers)
    {
        $this->nodeRenderers = $nodeRenderers;
    }

    /**
     * @return array
     */
    public function getTransitionRenderers()
    {
        return $this->transitionRenderers;
    }

    /**
     * @param array $transitionRenderers
     */
    public function setTransitionRenderers($transitionRenderers)
    {
        $this->transitionRenderers = $transitionRenderers;
    }

    /**
     * Is there a state node renderer for the given state name?
     *
     * @param $stateName
     * @return bool
     */
    public function hasNodeRendererByStateName($stateName)
    {
        return isset($this->nodeRenderers[$stateName]);
    }

    /**
     * Get the renderer for the given state name.
     *
     * If no renderer was set the default renderer Bob_StateMachine_Renderer_Node_DefaultRenderer() is returned
     *
     * @param $stateName
     * @return NodeRenderer
     */
    public function getNodeRendererByStateName($stateName)
    {
        if (isset($this->nodeRenderers[$stateName])) {
            return $this->nodeRenderers[$stateName];
        }
        return new NodeRenderer();
    }

    public function getTransitionRendererByStateName($stateName)
    {
        if (isset($this->transitionRenderers[$stateName])) {
            return $this->transitionRenderers[$stateName];
        }
        return new TransitionRenderer();
    }

    /**
     * Renders a dot graph into an svg
     *
     * @param string $dotString The dot graph that is fed into the
     * @return string|bool the resulting SVG
     */
    public function runDot($dotString)
    {
        $descriptorSpec = array(
            0 => array("pipe", "r"), // stdin
            1 => array("pipe", "w"), // stdout
            2 => array("pipe", "a") // stderr
        );

        $process = proc_open('dot -Tsvg', $descriptorSpec, $pipes);

        if (is_resource($process)) {
            fwrite($pipes[0], $dotString);
            fclose($pipes[0]);

            $svg = stream_get_contents($pipes[1]);
            fclose($pipes[1]);

            proc_close($process);
            $svg = explode('<svg ', $svg);

            // has it worked out?
            if (count($svg) < 2) {
                return false;
            }

            return '<svg ' . $svg[1];
        }

        return false;
    }

    /**
     * Creates a dot graph for a process
     *
     * @param StateCollection $stateCollection
     * @return string A dot graph
     */
    public function renderDot(StateCollection $stateCollection)
    {
        // define the graph
        $graph = 'digraph ' . 'test'
            . ' { dpi="56";compound="true";fontname="Arial";margin="";nodesep="0.6";rankdir="TD";ranksep="0.4";'
            . PHP_EOL;

        // add all states to the graph
        foreach ($stateCollection as $state) {
            $nodeRenderer = $this->getNodeRendererByStateName($state->getKey());
            $graph .= ' ' . $nodeRenderer->render($state);
        }

        // add all transitions to the graph
        foreach ($stateCollection as $state) {
            $nodeRenderer = $this->getTransitionRendererByStateName($state->getKey());
            $graph .= ' ' . $nodeRenderer->render($state);
        }

        $graph .= '}' . PHP_EOL;


        return $graph;
    }

    /**
     * @param Client $client
     * @param Context $context
     * @return string
     */
    public static function run(Client $client, Context $context = null)
    {
        $renderer = new static();
        $request = new StateQueryRequest($context);
        $request->expand('transitions[*]');

        $states = $client->execute($request)->toObject();

        $dotString = $renderer->renderDot($states);
        return $renderer->runDot($dotString);
    }
}
