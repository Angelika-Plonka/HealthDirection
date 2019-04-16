<?php

namespace App\Listener;

use App\Entity\Fitness;
use App\Model\FitnessCalculators;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;

class FitnessEventListener
{

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof Fitness) {
            $this->updateCalculations($entity);
        }
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof Fitness) {
            $this->updateCalculations($entity);
        }
    }

    private static function updateCalculations(Fitness $fitness)
    {
        FitnessCalculators::updateAllCalculations($fitness);
    }

}
