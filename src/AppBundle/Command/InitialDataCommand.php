<?php

namespace AppBundle\Command;

use AppBundle\Entity\Categories;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class InitialDataCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('set:initial:data')
            ->setDescription('Sets the initial data');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getManager();
        $cat = new Categories();
        $cat->setDescription('Other');
        $cat->setHasTaxes(true);
        $em->persist($cat);

        $cat = new Categories();
        $cat->setDescription('Books, Food and Medical products');
        $cat->setHasTaxes(false);
        $em->persist($cat);

        $em->flush();

        $output->writeln('SEEDING COMPLETE');
    }
}
