<?php

namespace Acme;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableSeparator;

class ShowCommand extends Command
{

    private $movieName;
    private $message;
    private $response;
    private $url;

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
        //$baseUrl = "http://www.omdbapi.com";
        $baseUrl = $_ENV["API_BASE_URL"];
        //$output->writeln("BaseURL from env: {$baseUrl}");
        $apiKey = "e175c3c2";
        $apiKey = $_ENV["API_KEY"];
        //$output->writeln("ApiKey from env: {$apiKey}");

        $this->url = "{$baseUrl}/?apikey={$apiKey}&t={$this->movieName}";
        //$output->writeln("url: {$this->url}");

        if (!$input->getOption('fullPlot')) {
            //$this->$url = 'http://www.omdbapi.com/?apikey=e175c3c2&t=scarface';
            $this->showInfo();
            $output->writeln("<info>******* Movie to show info:: {$this->movieName} >*******<info>");
        } else {
            //$this->$url = 'http://www.omdbapi.com/?apikey=e175c3c2&t=scarface&plot=full';
            $this->url = $this->url . "&plot=full";
            $output->writeln("url: {$this->url}");

            $this->showInfo();
            $output->writeln("<info>******* Movie to show info Full Plot:: {$this->movieName} >*******<info>");
        }

        $json = $this->response;
        $array = json_decode($json, true);
        $table = new Table($output);
        $table->setHeaderTitle("{$this->movieName}");
        foreach ($array as $clave => $valor) {
            if ($clave != "Ratings"){
                //$row = [ strval( $clave ), strval( $valor ) ];   
                $row = [$clave, strval($valor)];
                $table->addRow($row);
            }
        }
        $table->render();

        if (!$input->getOption('fullPlot')) {
            $output->writeln("\r\n\r\n<question> Want to know more about `{$this->movieName}`? Try adding --fullPlot after `show` command <question>");
        }

        return Command::SUCCESS;
    }

    private function showInfo()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $this->response = curl_exec($curl);

        curl_close($curl);

        $this->message .= "\r\n\r\n";
        //$this->message .= $response;

        //return $response;
    }
}
