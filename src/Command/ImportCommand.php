<?php
/**
 * Created by Matus Nickel
 * Date: 12/02/16
 * Time: 00:24
 */

namespace Command;

use Codito\Silex\Console\Command\AbstractCommand as Command;
use Service\ImportService as Service;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ConsoleController
 * @package Controller
 */
final class ImportCommand extends Command
{
    /**
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    protected function configure()
    {
        $this->setName('import')
            ->setDescription('Import XML graph into database')
            ->addArgument(
                'xmlfile',
                InputArgument::REQUIRED,
                'Graph file in XML format'
            );
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @throws \Interop\Container\Exception\ContainerException
     * @throws \Interop\Container\Exception\NotFoundException
     * @throws \InvalidArgumentException
     * @throws \ErrorException
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /* @var $app \DI\Bridge\Silex\Application */
        $app = $this->getApplication()->getSilexApplication();
        /* @var $service Service */
        $service = $app->getContainer()->get(Service::class);

        if (file_exists(getcwd().'/'.$input->getArgument('xmlfile'))) {
            $file = file_get_contents(getcwd().'/'.$input->getArgument('xmlfile'), 'r');
            $service->setFile($file);

            if ($service->import()) {
                $output->writeln('<info>Import successful!</info>');
            } else {
                throw new \ErrorException('Error occuerd during import. Please contact your service provider :).');
            }
        } else {
            throw new \InvalidArgumentException('File not found or invalid argument provided.');
        }
    }
}
