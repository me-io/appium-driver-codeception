<?php

namespace Appium\TestCase;

use Appium\Remote\AppiumRemoteDriver;

class TouchAction
{
    private $sessionUrl;
    private $driver;
    private $actions;

    /**
     * TouchAction constructor.
     *
     * @param \PHPUnit_Extensions_Selenium2TestCase_URL $sessionUrl
     * @param \Appium\Remote\AppiumRemoteDriver $driver
     */
    public function __construct(
        \PHPUnit_Extensions_Selenium2TestCase_URL $sessionUrl,
        AppiumRemoteDriver $driver
    ) {
        $this->sessionUrl = $sessionUrl;
        $this->driver = $driver;
        $this->actions = [];

        return $this;
    }

    /**
     * @return \Appium\TestCase\Element
     */
    public function TestCaseElement()
    {
        return new Element($this->driver, $this->sessionUrl);
    }

    /**
     * @param $params
     *
     * @return $this
     */
    public function tap($params)
    {
        $options = $this->getOptions($params);

        if (array_key_exists('count', $params)) {
            $options['count'] = $params['count'];
        } else {
            $options['count'] = 1;
        }

        $this->addAction('tap', $options);

        return $this;
    }

    /**
     * @param $params
     *
     * @return $this
     */
    public function press($params)
    {
        $options = $this->getOptions($params);

        $this->addAction('press', $options);

        return $this;
    }

    /**
     * @param $params
     *
     * @return $this
     */
    public function longPress($params)
    {
        $options = $this->getOptions($params);

        if (array_key_exists('duration', $params)) {
            $options['duration'] = $params['duration'];
        } else {
            $options['duration'] = 800;
        }

        $this->addAction('longPress', $options);

        return $this;
    }

    /**
     * @param $params
     *
     * @return $this
     */
    public function moveTo($params)
    {
        $options = $this->getOptions($params);

        $this->addAction('moveTo', $options);

        return $this;
    }

    /**
     * @param $params
     *
     * @return $this
     */
    public function wait($params)
    {
        $options = [];

        if (gettype($params) == 'array') {
            if (array_key_exists('ms', $params)) {
                $options['ms'] = $params['ms'];
            } else {
                $options['ms'] = 0;
            }
        } else {
            $options['ms'] = $params;
        }

        $this->addAction('wait', $options);

        return $this;
    }

    /**
     * @return $this
     */
    public function release()
    {
        $this->addAction('release', []);

        return $this;
    }

    /**
     * @return \PHPUnit_Extensions_Selenium2TestCase_Response
     */
    public function perform()
    {
        $params = [
            'actions' => $this->actions,
        ];
        $url = $this->sessionUrl->descend('touch')->descend('perform');

        return $this->driver->curl('POST', $url, $params);
    }

    /**
     * @return array
     */
    public function getJSONWireGestures()
    {
        $actions = [];
        foreach ($this->actions as $action) {
            $actions[] = $action;
        }

        return $actions;
    }

    /**
     * Get options and create element depending on the selector type sent in the options.
     *
     * @param $params
     *
     * @return array
     */
    public function getOptions($params)
    {
        $opts = [];

        if (array_key_exists('element', $params) && $params['element'] != null) {
            if (is_array($params['element']) && isset($params['element']['type']) && isset($params['element']['value'])) {
                /*
                 * Select the type of the selector sent in the options: ['element' => ['type' => 'xpath', 'value' => '//your_xpath']]
                 */
                $opts['element'] = $this->TestCaseElement()->by($params['element']['type'], $params['element']['value'])->getId();
            }
        }

        # it makes no sense to have x but no y, or vice versa.
        if (array_key_exists('x', $params) && array_key_exists('y', $params)) {
            $opts['x'] = $params['x'];
            $opts['y'] = $params['y'];
        }

        return $opts;
    }

    /**
     * @param $action
     * @param $options
     *
     * @return array
     */
    public function addAction($action, $options)
    {
        $gesture = [
            'action' => $action,
            'options' => $options,
        ];

        $this->actions[] = $gesture;

        return $this->actions;
    }
}
