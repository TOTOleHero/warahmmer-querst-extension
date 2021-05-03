<?php

namespace App\Controller;

use App\Entity\ProfileWHQ;
use App\Manager\ProfileManager;
use App\Manager\RuleManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CardController extends AbstractController
{

    /**
     *
     * @var ProfileManager
     */
    private $profileManager;

    /**
     *
     * @var RuleManager
     */
    private $ruleManager;

    public function __construct(ProfileManager $profileManager,RuleManager $ruleManager)
    {
        $this->profileManager = $profileManager;
        $this->ruleManager= $ruleManager;
    }



    /**
     * @Route("/card/edit/{cardId}", name="card_edit")
     */
    public function edit(): Response
    {
        return $this->render('card/card-edit.html.twig', [
            'cardData' => $this->getCardData()
        ]);
        
    }

    /**
     * @Route("/card/view/{cardId}", name="card_view")
     */
    public function index(): Response
    {
        return $this->render('card/card.html.twig', [
            'cardData' => $this->getCardData()
        ]);
    }


    protected function getCardData()
    {
        $profile = $this->profileManager->createProfile();

        $profileData = [
            'Cobra', // 'Monster Name'
            '1',// 'Level'
            '35',// 'Gold (Each)'
            '6',// 'Move'
            '4',// 'WS'
            '-',// 'BS'
            '2',// 'Strength'
            '1D6',// 'Damage'
            '2',// 'T'
            '2',// 'Wounds'
            '6',// 'Initiative'
            '1',// 'Attacks'
            '',
            '',
            '',
            '',
            '-',// 'Armor'
        ];

        $rulesData = [
            [
                'name' => 'Embuscade magique 6+',
                'description' => 'Embuscade et attaque sur 6+ avec 1D6. Même les sorciers ne peuvent riposter',
            ],
            [
                'name' => 'Poison',
                'description' => "Si les PV tombent à 0 par une attaque empoisonné, le guerrier obtient -1 en Force de façon permanente. Si il tombe à 0 en Force il meurt et est retiré de la partie.",
            ],
            [
                'name' => 'Attaque du cobra',
                'description' => "Sur un 5+ lors de l'attaque du Cobra, l'attaque ignore l'armure du guerrier",
            ]
        ];

        /** @var ProfileWHQ $profile */
        $profile
        ->setName($profileData[0])
        ->setBattleLevel($profileData[1])
        ->setGold($profileData[2])
        ->setMovement($profileData[3])
        ->setWeaponSkill($profileData[4])
        ->setBallisticSkill($profileData[5])
        ->setStrength($profileData[6])
        ->setDamageDice($profileData[7])
        ->setToughness($profileData[8])
        ->setWounds($profileData[9])
        ->setInitiative($profileData[10])
        ->setAttacks($profileData[11])
        ->setLuck($profileData[12])
        ->setWillPower($profileData[13])
        ->setSkills($profileData[14])
        ->setEscapePinning($profileData[15])
        ->setArmor($profileData[16])
        ;


        $rules = $this->ruleManager->createRules($rulesData);

        $cardData = [
                        [
                            'count' => '',
                            'profile' => $profile,
                            'image' => 'cobra.png',
                            'imageStyle' => 'width: 81px;right: 4px;bottom: 6px;',
                            'diceRoll' => $this->profileManager->getCombatLine($profile->getWeaponSkill()),
                            'rules' => $rules,
                        ]
            ];

            return $cardData;
    }

}
