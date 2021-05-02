<?php

namespace App\Manager;

use App\Entity\ProfileWHQ;
use App\Exception\WeaponSkillOuterRange;
use Symfony\Component\HttpKernel\Profiler\Profile;

class ProfileManager
{

    private $combatTable = [
    //0=>[1,2,3,4,5,6,7,8,9,10],
    1=>[4,4,5,6,6,6,6,6,6,6],
    2=>[3,4,4,4,5,5,6,6,6,6],
    3=>[2,3,4,4,4,4,5,5,5,6],
    4=>[2,3,3,4,4,4,4,4,5,5],
    5=>[2,3,3,3,4,4,4,4,4,4],
    6=>[2,3,3,3,3,4,4,4,4,4],
    7=>[2,3,3,3,3,3,4,4,4,4],
    8=>[2,2,3,3,3,3,3,4,4,4],
    9=>[2,2,2,3,3,3,3,3,4,4],
   10=>[2,2,2,2,3,3,3,3,3,4],
    ];

    
    public function createProfile()
    {
        return new ProfileWHQ();
    }


    public function getCombatLine($weaponSkill)
    {
        if( $weaponSkill < 0 || 10 < $weaponSkill)
        {
            throw new WeaponSkillOuterRange('WeaponSkill must be in strict range 1 => 10');
        }
        return $this->combatTable[intval($weaponSkill)];
    }
}