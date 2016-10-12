<?php
/**
 * Created by PhpStorm.
 * User: Hovhannisyan
 * Date: 23.04.2016
 * Time: 8:38
 */

namespace Football\Tournaments;


use Football\Tournaments\Types\AbstractType;
use Football\Tournaments\Types\DoubleRoundRobin;
use Football\Tournaments\Types\RoundRobin;
use Football\Tournaments\Types\EliminationKnockout;
use Football\Tournaments\Types\DoubleEliminationKnockout;
use Football\Tournaments\Types\MultiStage;
use InvalidArgumentException;

class Tournament
{
    static public function factory($driver)
    {
        switch ($driver->type()->type)
        {
            case 'DoubleRoundRobin':
                return DoubleRoundRobin::factory($driver);

            case 'RoundRobin':
                return RoundRobin::factory($driver); // todo::

            case 'EliminationKnockout':
                return EliminationKnockout::factory($driver); // todo::

            case 'DoubleEliminationKnockout':
                return DoubleEliminationKnockout::factory($driver); // todo::

            case 'MultiStage':
                return MultiStage::factory($driver); // todo::
        }

        throw new InvalidArgumentException("Unsupported driver [$driver]");
    }

}