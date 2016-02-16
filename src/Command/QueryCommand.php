<?php
/**
 * Pixel Federation s.r.o
 * Created by Matus Nickel
 * Date: 16/02/16
 * Time: 13:39
 */

namespace Command;

use Service\QueryService as Service;
use Codito\Silex\Console\Command\AbstractCommand as Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class QueryCommand extends Command
{
    /**
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    protected function configure()
    {
        $this->setName('query')
            ->setDescription('Query all paths or cheapest paths')
            ->addArgument(
                'jsonfile',
                InputArgument::REQUIRED,
                'Json file with query'
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

        if (file_exists(getcwd().'/'.$input->getArgument('jsonfile'))) {
            $file = file_get_contents(getcwd().'/'.$input->getArgument('jsonfile'), 'r');
            $jsonDecoded = json_decode($file);

            if ($jsonDecoded !== null && $service->setQueryArray($jsonDecoded) && $service->query()) {
                $output->writeln($service->getResult());
            } else {
                throw new \ErrorException(
                    'Error occuerd during query. Check your query format or contact your service provider :).'
                );
            }
        } else {
            throw new \InvalidArgumentException('File not found or invalid argument provided.');
        }
    }
}