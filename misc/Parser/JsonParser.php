<?php

namespace Parser;

use Parser\Helper\Helper;

/**
 * Class JsonParser
 *
 * @package App
 */
class JsonParser
{
    /** @var string */
    public $defaultJsonFile = __DIR__ . '/Json/AppiumCommand.json';

    /** @var mixed */
    public $jsonObject;

    /** @var array */
    protected $functionsArray = [];

    /** @var string */
    protected $classFileLocation = __DIR__ . '/../../src/Traits';

    /** @var string */
    protected $outputFileName = 'BaseCommands';

    /** @var string */
    protected $constantsOutputFileName = 'BaseConstants';

    /** @var array */
    protected $classArray = [];

    /** @var string */
    protected $classOutput = "";

    /** @var string */
    protected $classTemplate = "<?php \nnamespace Appium\\Traits;\n\ntrait BaseCommands \n{\n {{functions}}  \n}\n";

    /** @var string */
    protected $constantsOutput = "";

    /** @var string */
    protected $constantsTemplate = "<?php\nnamespace Appium\\Traits;\n\nclass BaseConstants\n{
                                    \n\t/** @var string */\n\tstatic public \$POST = 'POST';
                                    \n\t/** @var string */\n\tstatic public \$GET = 'GET';
                                    \n\t/** @var string */\n\tstatic public \$DELETE = 'DELETE';
                                    {{constants}}\n}\n";

    /** @var \Symfony\Component\Console\Output\OutputInterface Console output */
    protected $consoleOutput;

    /** @var string */
    protected $constants = "";

    /** @var array */
    protected $constantsArray = [];

    /**
     * JsonParser constructor.
     *
     * @param string $jsonFile
     */
    public function __construct(\Symfony\Component\Console\Output\OutputInterface $console, $jsonFile = '')
    {
        $this->consoleOutput = $console;
        $jsonFile = ($jsonFile) ? $jsonFile : $this->defaultJsonFile;
        $this->jsonObject = json_decode(file_get_contents($jsonFile), true);
    }

    /**
     * Generate class and constants
     *
     */
    public function generate()
    {
        foreach ($this->jsonObject as $key => $item) {
            $this->functionsArray[] = [
                'url' => $key,
                'details' => $this->getDetails($item),
            ];
        }

        $this->createFunctions()
            ->createConstants()
            ->createConstantsFile()
            ->createClassFile();

        $this->consoleOutput->writeln("<info>Finished \nYou will find output files in /Tools/Parser/output</info>");
    }

    /**
     * Get details for the function
     *
     * @param $data
     *
     * @return array
     *
     */
    protected function getDetails($data)
    {
        $details = [];

        foreach ($data as $key => $item) {
            $details[] = [
                'type' => $key,
                'options' => $item,
            ];
        }

        return $details;
    }

    /**
     * Create functions
     *
     * @return $this
     *
     */
    protected function createFunctions()
    {
        if (empty($this->functionsArray)) {
            echo "Functions not found";
            die(1);
        }

        foreach ($this->functionsArray as $key => $function) {
            list($inspectedUrl, $url) = $this->inspectUrl($function['url']);
            $this->functionsArray[$key]['urlConst'] = $inspectedUrl;
            $this->functionsArray[$key]['url'] = $url;
        }

        return $this;
    }

    /**
     * Create constants from template
     *
     * @return $this
     *
     */
    protected function createConstants()
    {
        $this->constantsOutput = str_replace('{{constants}}', $this->constants, $this->constantsTemplate);

        return $this;
    }

    /**
     * Save class output in the file
     *
     * @return $this
     *
     */
    protected function createClassFile()
    {
        foreach ($this->functionsArray as $key => $item) {
            if ($item['urlConst'] && !empty($item['details'])) {
                foreach ($item['details'] as $detail) {
                    $this->writeFunction($item['urlConst'], $detail['type'], $detail['options'], $item['url']);
                }

            }
            $this->classOutput .= "";
        }

        $this->classOutput = str_replace('{{functions}}', $this->classOutput, $this->classTemplate);

        file_put_contents($this->classFileLocation . '/' . $this->outputFileName . '.php', $this->classOutput);

        return $this;
    }

    /**
     * Write function
     *
     * @param $url
     * @param $options
     * @param $urlReal
     *
     * @return string
     *
     */
    protected function writeFunction($url, $type, $options, $urlReal)
    {
        // Skip the routs without the command
        if (!isset($options['command'])) {
            return "";
        }

        // Skip the routes with the same command
        if (isset($this->classArray[$options['command']])) {
            return "";
        }

        $routeParamsString = '';
        $optionsAnnotations = "\n\t/**\n";
        $optionsAnnotations .= "\t* " . $options['command'] . "\n\t*\n";

        $allOptions = $this->addOptions($options);
        $routeParams = $this->getUrlOptions($urlReal);
        if ($routeParams) {
            foreach ($routeParams as $key => $param) {
                $routeParamsString .= ($key) ? ", " : "";
                $routeParamsString .= "$" . $param['parameterName'];

            }
        }
        $optionsAnnotations .= ($allOptions) ? "\t* @param array \$data\n" : "";
        $optionsAnnotations .= ($allOptions) ? "\t* @options " . json_encode($allOptions) . "\n\t*\n" : "";
        $optionsAnnotations .= ($allOptions) ? "\t* @return mixed\n" : "";
        $options_ = ($allOptions) ? "\$data" : "";
        $routeParamsString = ($allOptions && $routeParamsString) ? ", " . $routeParamsString : $routeParamsString;
        $this->classOutput .= $optionsAnnotations . "\t*\n\t**/\n";
        $this->classOutput .= "\tpublic function " . $options['command'] . "(" . $options_ . "" . $routeParamsString . "){\n";

        $this->classOutput .= "\t\t" . $this->getCommand($url, $type, $options_, $routeParams) . "\n\t}";
        $this->classArray[$options['command']] = $options['command'];

        return $options['command'];
    }

    /**
     * Get the command for the function
     *
     * @param $url
     * @param $type
     * @param $data
     * @param $routeParams
     *
     * @return string
     *
     */
    protected function getCommand($url, $type, $data, $routeParams)
    {
        $routeParamsString = "";
        $data = ($data) ? ", \$data" : '';
        $urlString = $this->constantsOutputFileName . "::$" . $url;
        if ($routeParams) {
            $urlString = "\$url";
            foreach ($routeParams as $param) {
                $routeParamsString .= "\t\$url = str_replace('" . $param['replace'] . "', $" . $param['parameterName'] . ", " . $this->constantsOutputFileName . "::$" . $url . ");\n\t\t";
            }
        }
        $command = $routeParamsString . "\treturn \$this->driverCommand(" . $this->constantsOutputFileName . "::$" . $type . ", " . $urlString . $data . ");";

        return $command;
    }

    /**
     * Add options
     *
     * @param $options
     *
     * @return array
     *
     */
    protected function addOptions($options)
    {
        $allOptions = [];

        if (!$options) {
            return $allOptions;
        }

        if (isset($options['payloadParams'])) {
            $allOptions = $options['payloadParams'];
        }

        return $allOptions;
    }

    /**
     * Save class output in the file
     *
     * @return $this
     */
    protected function createConstantsFile()
    {
        file_put_contents($this->classFileLocation . '/' . $this->constantsOutputFileName . '.php', $this->constantsOutput);

        return $this;
    }

    /**
     * Inspect url
     *
     * @param string $url
     *
     * @return string
     *
     */
    protected function inspectUrl($url)
    {
        // Skip the one that don't have the :sessionId
        if (strpos($url, ':sessionId/') === false) {
            return '';
        }

        $urlArray = explode(':sessionId/', $url);
        $urlParts = explode('/', $urlArray[1]);
        $constantName = $this->generateUnqConstant($urlParts);

        $this->constants .= "\n\t/** @var string */\n\t static public \$" . $constantName . " = '" . $urlArray[1] . "';\n";

        return [$constantName, $urlArray[1]];
    }

    /**
     * Get url options
     *
     * @param $url
     *
     * @return array
     *
     */
    protected function getUrlOptions($url)
    {
        return Helper::getBetweenAll($url);
    }

    /**
     * Inspect options and return the command name
     *
     * @param $options
     *
     * @return string
     *
     */
    protected function inspectOptions($options)
    {
        // Skip items without commands
        if (!isset($options['command'])) {
            return '';
        }

        return $options['command'];
    }

    /**
     * Generate uniq constant
     *
     * @param $urlParts
     *
     * @return string
     *
     */
    protected function generateUnqConstant($urlParts)
    {
        $constantName = strtoupper($urlParts[count($urlParts) - 1]);
        // Check if its parameter and replace with bottom line if it is
        $constantName = (strpos($constantName, ':') === false) ? $constantName : strtoupper($urlParts[count($urlParts) - 2]) . str_replace(':', '_', $constantName);
        $uniqConstant = (count($urlParts) > 1) ? str_replace(':', '_', strtoupper($urlParts[count($urlParts) - 2])) : '';
        // Check if we already have the same constant and add uniqConstant if we have
        $constantName = (!isset($this->constantsArray[$constantName])) ? $constantName : $constantName . "_" . $uniqConstant;
        $this->constantsArray[$constantName] = $constantName;

        return $constantName;
    }
}
