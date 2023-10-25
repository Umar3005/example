<?php

namespace App\Command;

use App\Entity\Interface\RoleInterface;
use App\Entity\Interface\UserInterface;
use App\Entity\Role;
use App\Model\Factory\RoleFactory;
use App\Model\Factory\UserFactory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:add-user')]
class AddUserCommand extends Command
{
    private RoleFactory $roleFactory;

    private UserFactory $userFactory;

    private EntityManagerInterface $entityManager;

    public function __construct(
        RoleFactory $roleFactory,
        UserFactory $userFactory,
        EntityManagerInterface $entityManager
    ) {
        parent::__construct();
        $this->roleFactory   = $roleFactory;
        $this->userFactory   = $userFactory;
        $this->entityManager = $entityManager;
    }


    protected function configure(): void
    {
        $this->addArgument('user_name', InputArgument::REQUIRED)
            ->addArgument('password', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $username = $input->getArgument('user_name');
        $password = $input->getArgument('password');

        if (!$username || !$password) {
            return self::INVALID;
        }

        $user = $this->createUser($input->getArguments());

        $output->writeln('User ' . $user->getUsername() . ' successfully created!');
        return self::SUCCESS;
    }


    private function createUser(array $data): UserInterface
    {
        $user = $this->userFactory->create(array_merge($data, [UserInterface::ROLE_ID_FIELD => $this->getRoleEntity()]));
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }

    private function getRoleEntity(): RoleInterface
    {
        $repository = $this->entityManager->getRepository(Role::class);
        $role = $repository->findOneBy(['name' => RoleInterface::DEFAULT_ROLE]);

        if (!$role) {
            $role = $this->createRole();
        }

        return $role;
    }

    private function createRole(): RoleInterface
    {
        $role = $this->roleFactory->create([RoleInterface::NAME_FIELD => RoleInterface::DEFAULT_ROLE]);
        $this->entityManager->persist($role);
        $this->entityManager->flush();
        return $role;
    }
}
