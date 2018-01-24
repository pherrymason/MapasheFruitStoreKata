<?php

namespace Mapashe;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class ProcessCommand extends Command
{
    protected function configure()
    {
        $this->setName('mapashe:process');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $store = new Store();
        $cart = new Cart($store);


        do {
            $helper = $this->getHelper('question');
            $question = new Question('Put your product in your basket: ', 'AcmeDemoBundle');

            $answer = $helper->ask($input, $output, $question);

            if ($this->isCsv($answer)) {
                foreach ($this->parseCsv($answer) as $itemName) {
                    $cart->addItem($itemName);
                }
            } else {
                $cart->addItem($answer);
            }

            $output->writeln("\tTotal: ".$cart->getTotal().'€');

        } while(true);
    }

    protected function isCsv(string $input): bool
    {
        return (strpos($input, ',') !== false);
    }

    protected function parseCsv(string $input): array
    {
        return explode(',', $input);
    }
}
