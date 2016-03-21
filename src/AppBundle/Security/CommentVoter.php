<?php

namespace AppBundle\Security;

use AppBundle\Entity\Comment;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class CommentVoter extends Voter
{
    const EDIT = 'edit';

    private $decisionManager;

    public function __construct(AccessDecisionManagerInterface $decisionManager)
    {

        $this->decisionManager = $decisionManager;
    }

    protected function supports($attribute, $subject)
    {
        if (!$subject instanceof Comment) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $comment = $subject;

        $user = $token->getUser();
        if (!$user instanceof UserInterface) {
            return false;
        }

        if($comment->getUser() == $user->getUsername()){
            return true;
        }

        if ($this->decisionManager->decide($token, array('ROLE_ADMIN'))) {
            return true;
        }

        return false;
    }
}