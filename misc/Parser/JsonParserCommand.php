<?php

namespace Parser;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class JsonParserCommand
 *
 * @package Parser
 */
class JsonParserCommand extends Command
{
    /**
     * Configure the commands
     */
    protected function configure()
    {
        $this->setName('generate:all')
             ->setDescription('Generate all commands from the json routs.')
             ->setHelp("With this command you will generate all commands located in json found here: 
            https://github.com/appium/appium-base-driver/blob/master/lib/mjsonwp/routes.js ");
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
        $output->writeln("<info>Start generating ...</info>");
        (new JsonParser($output))->generate();
    }
}