<?php

namespace AppiumCodeceptionCLI\Parser;

use Symfony\Component\Console\Style\SymfonyStyle;
use AppiumCodeceptionCLI\Parser\Helpers\TextTable;

/**
 * Class JsonParser
 *
 * @package App
 */
class JsonParser
{
    /** @var string */
    public $defaultJsonFile = __DIR__ . '/Json/AppiumCommandFull.json';

    /** @var string */
    public $defaultJsonExtraFile = __DIR__ . '/Json/AppiumCommandExtra.json';

    /** @var string */
    public $defaultJsonRouteFile = __DIR__ . '/Json/AppiumCommandRoute.json';
    /** @var string */
    public $defaultJsonRouteOverrideFile = __DIR__ . '/Json/AppiumCommandOverride.json';

    /** @var string */
    public $defaultJsonWireFile = __DIR__ . '/Json/jsonwire-full.json';

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

    /** @var \Symfony\Component\Console\Style\SymfonyStyle */
    protected $symfonyStyle;

    /** @var string */
    protected $constants = "";

    /** @var array */
    protected $constantsArray = [];

    /**
     * JsonParser constructor.
     *
     * @param \Symfony\Component\Console\Style\SymfonyStyle $symfonyStyle
     * @param string                                        $jsonFile
     */
    public function __construct(SymfonyStyle $symfonyStyle, $jsonFile = '')
    {
        $this->symfonyStyle = $symfonyStyle;
        $jsonFile           = ($jsonFile) ? $jsonFile : $this->defaultJsonFile;
        $this->jsonObject   = json_decode(file_get_contents($jsonFile), true);
    }

    /**
     * Generate class and constants
     *
     */
    public function generate()
    {
        $this->generateFullFile()
             ->createFunctions()
             ->createConstants()
             ->createConstantsFile()
             ->createClassFile()
             ->generateDocMd();

        $this->symfonyStyle->success("You will find output files in {$this->classFileLocation}");
    }

    public function itemList($arr)
    {
        $list = '';
        foreach ($arr as $value) {
            $listItem = (is_array($value) ? $this->itemList($value) : $value);
            $list     .= "- $listItem";
        }
        $list .= '';

        return $list;
    }

    public function generateDocMd()
    {
        $columns = ['Method Name', 'HTTP', 'Url/Desc', 'Payload'];
        $rows    = [];
        foreach ($this->functionsArray as $function) {
            $params = '';
            if ($function['payloadParams']) {
                $params = json_encode($function['payloadParams'], JSON_ERROR_UNSUPPORTED_TYPE);
            }


            $rows[] = [
                $function['name'],
                $function['http_method'],
                $function['url'] . "<br>" . $function['desc'],
                $params,
            ];
        }
        $t         = new TextTable($columns, $rows);
        $t->maxlen = 400;
        //$t->setAlgin(['L', 'C', 'R']);

        $mdTable = $t->render();

        $readMeFile = __DIR__ . '/../../APPIUM_CORE_FUNCTIONS.md';
        $txt        = file_get_contents($readMeFile);
        $txtNew     = $this->replaceInStrWithDel($txt, '[comment]: # (core-function-comment)', $mdTable);
        file_put_contents($readMeFile, $txtNew);
    }

    public function replaceInStrWithDel($str, $del, $replace)
    {
        $txtArr = explode($del, $str);

        $newStr = join(
            "\n",
            [
                trim($txtArr[0]),
                "$del\n\n" . $replace . "\n\n$del",
                trim($txtArr['2']),
            ]
        );

        return $newStr;
    }

    public function httpMethod($str)
    {
        $isPost = stristr($str, 'POST /');
        if ($isPost) {
            return 'POST';
        }
        $isGET = stristr($str, 'GET /');
        if ($isGET) {
            return 'GET';
        }

        $isDELETE = stristr($str, 'DELETE /');
        if ($isDELETE) {
            return 'DELETE';
        }

        return 'NA';
    }

    public function getCommandNameOfUrl($url, $verb = '')
    {
        $urlExt = str_ireplace(['get', 'post', 'delete'], '', $url);
        $urlExt = str_ireplace('/wd/hub/session', '', $urlExt);
        $urlExt = preg_replace('#(:\w+)#', '', $urlExt);
        $urlExt = preg_replace('#\/\/#', '/', $urlExt);
        $urlExt = trim($urlExt, '/');
        $urlExt = trim($urlExt);

        $urlExtArr     = explode('/', $urlExt);
        $urlExtArr     = array_unique($urlExtArr);
        $urlExtArrLast = array_slice($urlExtArr, -2, 2);


        $urlStr = join('_', $urlExtArrLast);
        $urlStr = strtolower($verb) . '_' . $urlStr;


        return $urlStr;
    }

    public function toCamelCase($string, $del, $capitalizeFirstCharacter = false)
    {

        $str = str_replace($del, '', ucwords($string, $del));

        if (!$capitalizeFirstCharacter) {
            $str = lcfirst($str);
        }

        return $str;
    }


    protected function generateFullFile()
    {
        $arrCommands = [];

        $jsonWireObject          = json_decode(file_get_contents($this->defaultJsonWireFile), true);
        $jsonRouteObject         = json_decode(file_get_contents($this->defaultJsonRouteFile), true);
        $jsonRouteObjectOverRide = json_decode(file_get_contents($this->defaultJsonRouteOverrideFile), true);
        $extraRouteObject        = json_decode(file_get_contents($this->defaultJsonExtraFile), true);

        $jsonRouteObjectSm = [];
        $jsonWireObjectSm  = [];

        foreach ($jsonRouteObject as $key => $value) {
            $jsonRouteObjectSm[strtolower($key)] = $value;
        }

        foreach ($extraRouteObject as $key => $value) {
            $jsonRouteObjectSm[strtolower($key)] = $value;
        }

        // convert route file to method route so we can match it with jsonwire full
        $jsonRouteObjectSmVerb = [];
        foreach ($jsonRouteObjectSm as $key => $value) {
            foreach ($value as $verb => $verbValue) {
                $verbValue['http_method']                                          = $verb;
                $verbValue['src']                                                  = 'route.json';
                $verbValue['link']                                                 = ['https://github.com/appium/appium-base-driver/blob/master/lib/protocol/routes.js'];
                $jsonRouteObjectSmVerb[strtolower($verb) . ' ' . strtolower($key)] = $verbValue;
            }
        }

        // override
        foreach ($jsonRouteObjectOverRide as $key => $value) {
            foreach ($value as $verb => $verbValue) {
                $orgArr = ($jsonRouteObjectSmVerb[strtolower($verb) . ' ' . strtolower($key)]);

                $jsonRouteObjectSmVerb[strtolower($verb) . ' ' . strtolower($key)] = array_merge($orgArr, $verbValue);
            }
        }

        foreach ($jsonWireObject as $key => $commandDesc) {
            preg_match('#\w+ #', $key, $match);
            $httpMethod                            = trim($match[0]);
            $keyUrl                                = str_replace(' ', ' /wd/hub', $key);
            $jsonWireObjectSm[strtolower($keyUrl)] = [
                'desc'        => $commandDesc,
                'http_method' => $httpMethod,
                'src'         => 'jsonwire-full',
                'link'        => ['https://github.com/admc/wd/blob/master/doc/jsonwire-full-mapping.md'],
            ];
        }


        // add not founds
        foreach ($jsonRouteObjectSmVerb as $key => $value) {
            $cmdDetail = $jsonWireObjectSm[$key] ?? false;
            if (!$cmdDetail) {
                $jsonWireObjectSm[$key] = [
                    'desc'        => $key,
                    'http_method' => $value['http_method'],
                ];
            }
        }

//        foreach ($jsonWireObjectSm as $key => $commandDesc) {
//            $cmdDetail = $jsonRouteObjectSmVerb[$key] ?? false;
//
//            if (!$cmdDetail) {
//                 add extra Commands
//                $jsonWireObjectSm[$key] = [
//                    'desc' => $commandDesc,
//                    'http_method' => $httpMethod
//                ];
//            }
//        }

        foreach ($jsonWireObjectSm as $key => $commandDesc) {
            $cmd       = $key;
            $urlNoVerb = str_ireplace(['post', 'get', 'delete',], '', $key);
            $url       = str_ireplace(['/wd/hub', '/session/:sessionid'], '', $urlNoVerb);
            $url       = trim($url);

            $cmdDetail = $jsonRouteObjectSmVerb[$key] ?? false;

            if ($cmdDetail) {
                if (!isset($cmdDetail['command'])) {
                    $cmdDetail['command'] = $this->toCamelCase($this->getCommandNameOfUrl($cmd,
                        $commandDesc['http_method']), '_');
                }
                preg_match_all('#:(\w+)#', $url, $matches);
                $urlParams = array_unique($matches[1]);

                // remove validate
                $payload = [];

                if (!empty($cmdDetail['payloadParams']['required'])) {
                    $payload['required'] = $cmdDetail['payloadParams']['required'];
                }

                if (!empty($cmdDetail['payloadParams']['optional'])) {
                    $payload['optional'] = $cmdDetail['payloadParams']['optional'];
                }

                $arrCommands[$key] = [
                    'url'           => $url,
                    'wdUrl'         => trim($urlNoVerb),
                    'name'          => $cmdDetail['command'],
                    'desc'          => $cmdDetail['desc'] ?? $commandDesc['desc'],
                    'http_method'   => $this->httpMethod($key),
                    'uriParams'     => $urlParams ?? [],
                    'payloadParams' => $payload,
                    'src'           => $cmdDetail['src'] ?? '',
                    'note'          => $cmdDetail['note'] ?? '',
                    'link'          => $cmdDetail['link'] ?? [],
                ];
            }
        }

        file_put_contents($this->defaultJsonFile,
            json_encode($arrCommands, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

        $this->functionsArray = $arrCommands;

        return $this;
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
            $this->addConstant(strtoupper($function['name']), $function['url']);
        }

        return $this;
    }

    /**
     * Create constants from template
     *
     * @return $this
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
     */
    protected function createClassFile()
    {
        foreach ($this->functionsArray as $key => $function) {
            if (!empty($function['url'])) {
                $this->writeFunction($function);
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
     * @param $function
     *
     * @return string
     *
     */
    protected function writeFunction($function)
    {
        // Skip the routes without the command
        if (!isset($function['url'])) {
            return "";
        }

        $routeParamsString  = '';
        $optionsAnnotations = "\n\t/**\n";
        $optionsAnnotations .= "\t* " . $function['name'] . "\n\t*\n";

        $allOptions = $function['payloadParams'];

        $routeParams = $function['uriParams'];

        if ($routeParams) {
            foreach ($routeParams as $key => $param) {
                $routeParamsString .= ($key) ? ", " : "";
                $routeParamsString .= "$" . $param;
            }
        }

        $optionsAnnotations .= ($function['desc']) ? "\t* {$function['desc']}\n" : "";
        $optionsAnnotations .= ($function['note']) ? "\t* @note {$function['note']}\n" : "";

        foreach ($function['link'] as $link) {
            $optionsAnnotations .= "\t* @link {$link}\n";
        }

        $optionsAnnotations .= ($function['src']) ? "\t* @source {$function['src']}\n" : "";
        $optionsAnnotations .= ($allOptions) ? "\t* @param array \$data\n" : "";
        $optionsAnnotations .= ($allOptions) ? "\t* @options " . json_encode($allOptions) . "\n\t*\n" : "";
        $optionsAnnotations .= ($allOptions) ? "\t* @return mixed\n" : "";
        $options_           = ($allOptions) ? "\$data" : "";
        $routeParamsString  = ($allOptions && $routeParamsString) ? ", " . $routeParamsString : $routeParamsString;
        $this->classOutput  .= $optionsAnnotations . "\t*\n\t**/\n";
        $this->classOutput  .= "\tpublic function " . $function['name'] . "(" . $options_ . "" . $routeParamsString . "){\n";

        $this->classOutput                   .= "\t\t" . $this->getCommand($function['url'], $function['http_method'],
                $options_, $function['uriParams']) . "\n\t}";
        $this->classArray[$function['name']] = $function['name'];

        return $function['name'];
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
     */
    protected function getCommand($url, $type, $data, $routeParams)
    {
        $routeParamsString = "";
        $data              = ($data) ? ", \$data" : '';
        $urlString         = "'$url'";
        if ($routeParams) {
            $urlString         = "\$url";
            $routeParamsString .= "\t\$url = '" . $url . "';\n\t\t";
            foreach ($routeParams as $param) {
                $routeParamsString .= "\t\$url = str_ireplace(':" . $param . "', $" . $param . ", \$url );\n\t\t";
            }
        }
        $command = $routeParamsString . "\treturn \$this->driverCommand(" . $this->constantsOutputFileName . "::$" . $type . ", " . $urlString . $data . ");";

        return $command;
    }

    /**
     * Save class output in the file
     *
     * @return $this
     */
    protected function createConstantsFile()
    {
        file_put_contents($this->classFileLocation . '/' . $this->constantsOutputFileName . '.php',
            $this->constantsOutput);

        return $this;
    }

    /**
     * Inspect url
     *
     * @param string $name
     * @param string $value
     *
     * @return mixed
     *
     */
    protected function addConstant($name, $value)
    {
        $nameSm = strtolower($name);

        if (!isset($this->constantsArray[$nameSm])) {
            $this->constants               .= "\n\t/** @var string */\n\tpublic static \$" . $name . " = '" . $value . "';\n";
            $this->constantsArray[$nameSm] = $value;
        } else {
            echo "Duplicate key constants :" . $name . ' -- ' . $value . "\n";
        }
    }
}
