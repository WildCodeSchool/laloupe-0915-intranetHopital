<?php
// src/Application/Sonata/UserBundle/Command/DesactivateUserCommand.php

namespace Application\Sonata\UserBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DesactivateUserCommand extends ContainerAwareCommand {

    /**
     * TODO Set cron task on server : do php app/console user:out:desactivate
     */
    protected function configure()
    {
        $this
        ->setName('user:out:desactivate')
        ->setDescription('Desactivate out user')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getEntityManager();
        $nb = $em->getRepository('ApplicationSonataUserBundle:User')->desactivateOutUser();

        $output->writeln(sprintf('Desactivate %d out user', $nb));
    }
}