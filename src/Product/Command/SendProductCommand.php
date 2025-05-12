<?php

namespace App\Product\Command;

use App\Product\Message\ProductMessage;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\Exception\ExceptionInterface;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsCommand(name: 'app:send-product')]
class SendProductCommand extends Command
{
    public function __construct(
        private readonly MessageBusInterface $bus
    ) {
        parent::__construct();
    }

    /**
     * @throws ExceptionInterface
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->bus->dispatch(new ProductMessage(
            id: 1,
            name: 'велосипед_10',
            measurements: [
                'weight' => 10,
                'height' => 100,
                'width' => 50,
                'length' => 150,
            ],
            description: 'Горный велосипед',
            cost: 10000,
            tax: 500,
            version: 1
        ));

        $output->writeln('Сообщение отправлено.');
        return Command::SUCCESS;
    }
}
