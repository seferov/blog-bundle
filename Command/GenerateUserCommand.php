<?php

/*
 * (c) Farhad Safarov <https://farhadsafarov.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Seferov\BlogBundle\Command;

use Seferov\BlogBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateUserCommand extends ContainerAwareCommand
{
    public function configure()
    {
        $this
            ->setName('seferov:blog:generate-user')
            ->setDescription('Generates a new user for admin')
            ->addArgument('username', InputArgument::REQUIRED)
            ->addArgument('password', InputArgument::REQUIRED)
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine.orm.default_entity_manager');

        $user = $em->getRepository('SeferovBlogBundle:User')
            ->loadUserByUsername($input->getArgument('username'));

        if ($user) {
            throw new InvalidArgumentException(sprintf('User already exists with username "%s"', $input->getArgument('username')));
        }

        $user = new User();
        $encoder = $this->getContainer()->get('security.password_encoder');
        $encoded = $encoder->encodePassword($user, $input->getArgument('password'));

        $user->setUsername($input->getArgument('username'))
            ->setPassword($encoded)
            ->setRoles(['ROLE_ADMIN']);

        $em->persist($user);
        $em->flush();

        $output->writeln('<info>User created!</info>');
    }
}
