<?php namespace Acme;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class ShowCommand extends Command {

    private $movieName;
    private $message;

    public function configure()
    {
        $this->setName('show')
            ->setDescription('Show info about a movie.')
            ->addArgument('moviename', InputArgument::REQUIRED, 'Movie`s name to search.')
            ->addOption('fullPlot', null, InputOption::VALUE_NONE, 'Search full info about movie');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->movieName = $input->getArgument('moviename');
        $this->showBasicInfo();
        $output->writeln($this->message);

        if ($input->getOption('fullPlot'))
        {
            $this->showFullInfo();
            $output->writeln($this->message);
        }else{
            $output->writeln("\r\n\r\n<question> Want to know more about `{$this->movieName}`? Try adding --fullPlot after `show` command <question>");
        }
    
        return 0; //I had to add this return due to an error in console to execute ./laracasts sayHelloTo hello
    }

    private function showBasicInfo()
    {
        $this->message = "<comment>******* Movie to show info {$this->movieName} >*******<comment>";


    }

    private function showFullInfo()
    {
        $this->message = "\r\n<info>+++ Full info +++<info>";



    }

}