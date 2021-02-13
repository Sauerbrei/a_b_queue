<?php

declare(strict_types=1);

namespace App\Command\Demo;

use App\Manager\DiscountManager;
use App\Manager\UserManager;
use App\Service\Factory\Entity\DiscountFactory;
use App\Service\Factory\Entity\UserFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class GenerateTestDataCommand
 *
 * @package App\Command\Demo
 */
class GenerateTestDataCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'abqueue:generate:testdata';
    /**
     * @var UserManager
     */
    private UserManager $userManager;
    /**
     * @var DiscountManager
     */
    private DiscountManager $discountManager;
    /**
     * @var DiscountFactory
     */
    private DiscountFactory $discountFactory;

    /**
     * GenerateTestDataCommand constructor.
     *
     * @param UserManager     $userManager
     * @param DiscountManager $discountManager
     * @param DiscountFactory $discountFactory
     */
    public function __construct(
        UserManager $userManager,
        DiscountManager $discountManager,
        DiscountFactory $discountFactory
    ) {
        parent::__construct(self::$defaultName);
        $this->userManager = $userManager;
        $this->discountManager = $discountManager;
        $this->discountFactory = $discountFactory;
    }

    protected function configure()
    {
        parent::configure();
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $amountDiscounts = 12; //$input->getOption('amountDiscounts'); //YAGNI
        $amountUsers = 2; //$input->getOption('amountUsers'); //YAGNI
        for ($i = 0; $i < $amountUsers; $i++) {
            $user = UserFactory::createUser()->setFirstName('Test'.$i)->setLastName('User'.$i);
            $this->userManager->save($user);
        }
        for ($i = 0; $i < $amountDiscounts; $i++) {
            $discount = $this->discountFactory->createDiscount()->setCode(md5((string)$i));
            $this->discountManager->save($discount);
        }

        return Command::SUCCESS;
    }
}