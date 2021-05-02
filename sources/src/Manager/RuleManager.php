<?php

namespace App\Manager;

use App\Entity\ProfileWHQ;
use App\Entity\Rule;
use Symfony\Component\HttpKernel\Profiler\Profile;
use Symfony\Component\Uid\Uuid;

class RuleManager
{

    public function createRule($name,$description)
    {
        $rule = new Rule();
        $rule
            ->setName($name)
            ->setDescription($description)
        ;

        $rule->setId(Uuid::v4());
        return $rule;
    }


    public function createRules($rulesData)
    {
        $rules = [];
        foreach($rulesData as $data )
        {
            $rules[] = $this->createRule($data['name'],$data['description']);
        }

        return $rules;
    }

}