<?php

namespace App\Command;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;


class CrearAdminUserCommand extends Command
{
    private $entityManager;
    private $passwordEncoder;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordEncoder)
    {
        parent::__construct();

        $this->entityManager = $entityManager;
        $this->passwordEncoder = $passwordEncoder;
    }

    protected function configure()
    {
        $this
            ->setName('app:crear-admin-user')
            ->setDescription('Crea un usuario administrador');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln([
            'Admin User Creator',
            '===================',
            '',
        ]);

        $username = 'adminComando';
        $email = 'adminComando@gmail.com';
        $password = 'adminComando1234';

        $user = new User();
        $user->setEmail($email);
        $user->setRoles(['ROLE_ADMIN']);
        $user->setNombre($username);
        $user->setIsVerified(true);
        $user->setFoto('default.jpg');

        $encodedPassword = $this->passwordEncoder->hashPassword($user, $password);
        $user->setPassword($encodedPassword);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $output->writeln('Nuevo administradorr creadoooo con éxito000!!');

        return Command::SUCCESS;
    }
}