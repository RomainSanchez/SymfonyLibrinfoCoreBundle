<?php

namespace Librinfo\CoreBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\OutputInterface;

trait PatcherLogger
{
    private $messages = [];

    public function info($message, $ln = true)
    {
        $this->addMessage('info', $message, $ln);
    }

    public function comment($message, $ln = true)
    {
        $this->addMessage('comment', $message, $ln);
    }

    public function error($message, $ln = true)
    {
        $this->addMessage('error', "\n\r\n\r  " . $message . "\n\r", $ln);
    }

    public function addMessage($severity, $message, $ln = true)
    {
        $this->messages[] = [
            'ln'      => $ln,
            'message' => '<' . $severity . '>' . $message . '</' . $severity . '>'
        ];
    }

    public function displayMessages($output)
    {
        if (count($this->messages) != 0)
            foreach ($this->messages as $mess)
                if ($mess['ln'])
                    $output->writeln($mess['message']);
                else
                    $output->write($mess['message']);
    }
}