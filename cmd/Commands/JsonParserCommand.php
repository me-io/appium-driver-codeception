<?php

namespace AppiumCodeceptionCLI\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Class JsonParserCommand
 *
 * @package Parser
 */
class JsonParserCommand extends Command
{
    /**
     * Configure the Commands
     *
     */
    protected function configure()
    {
        $this->setName('generate:all')
             ->addUsage('generate:all <options>')
             ->setDescription('Generate all Commands from the json routes.')
             ->setHelp('Generate all Commands located in json found here: 
    * https://github.com/appium/appium-base-driver/blob/master/lib/mjsonwp/routes.js 
    * https://github.com/admc/wd/blob/master/doc/jsonwire-full.json 
             ');
    }

    /**
     * Execute the command
     *
     * @param \Symfony\Component\Console\Input\InputInterface   $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return mixed
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $style = new SymfonyStyle($input, $output);
        $style->success('Start generating ...');
        (new JsonParser($output))->generate();
    }
}
