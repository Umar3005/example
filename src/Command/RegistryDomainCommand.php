<?php

namespace App\Command;

use App\Model\Factory\SettingsFactory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:registry-domain')]
class RegistryDomainCommand extends Command
{
    private EntityManagerInterface $entityManager;

    private SettingsFactory $settingsFactory;

    public function __construct(EntityManagerInterface $entityManager, SettingsFactory $settingsFactory)
    {
        parent::__construct();
        $this->entityManager   = $entityManager;
        $this->settingsFactory = $settingsFactory;
    }


    protected function configure()
    {
        $this->addArgument('connection_id', InputArgument::REQUIRED)
            ->addArgument('protocol', InputArgument::REQUIRED)
            ->addArgument('domain', InputArgument::REQUIRED)
            ->addArgument('check_url', InputArgument::OPTIONAL)
            ->addArgument('send_response_with_timeout', InputArgument::OPTIONAL)
            ->addArgument('response_delay_time', InputArgument::OPTIONAL);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->createSettings($input->getArguments());

        $connectionId = $input->getArgument('connection_id');
        $domain = $input->getArgument('domain');
        $output->writeln('Domain ' . $domain . ' for connection_id = ' . $connectionId . ' successfully registered');
        return Command::SUCCESS;
    }


    private function createSettings(array $data): void
    {
        $settings = $this->settingsFactory->create($data);
        $this->entityManager->persist($settings);
        $this->entityManager->flush();
    }
}
