<?php

namespace App\Security;

use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use App\Entity\Fitness;
use App\Entity\User;

class FitnessVoter extends Voter
{

    const ATTRIBUTE_EDIT = 'edit_fitness';
    const ATTRIBUTE_SHOW = 'show_fitness';

    private $decisionManager;

    public function __construct(AccessDecisionManagerInterface $decisionManager)
    {
        $this->decisionManager = $decisionManager;
    }

    protected function supports($attribute, $subject)
    {
        if (!in_array($attribute, [
                self::ATTRIBUTE_EDIT,
                self::ATTRIBUTE_SHOW,
            ])) {
            return false;
        }

        if (!$subject instanceof Fitness) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        /* @var $user \App\Entity\User */
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        $fitness = $subject;

        switch ($attribute) {
            case self::ATTRIBUTE_EDIT:
            case self::ATTRIBUTE_SHOW:
                return $this->canEditAndShow($fitness, $user);
        }

        throw new \LogicException('Błędne dane votera: ' . $attribute);
    }

    /**
     *
     * @param Fitness $fitness
     * @param User $user
     * @return boolean
     */
    private function canEditAndShow(Fitness $fitness, User $user)
    {
        return $user === $fitness->getUser();
    }

}
