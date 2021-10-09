<?php


namespace App\Models;


/**
 * Class Investor
 * @package App\Models
 */
class Investor
{

    /**
     * @var int
     */
    private $id;
    /**
     * @var float
     */
    private $virtualWallet;

    /**
     * Investor constructor.
     * @param int $id
     * @param float $virtualWallet
     */
    public function __construct(int $id, float $virtualWallet)
    {
        $this->id = $id;
        $this->virtualWallet = $virtualWallet;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return float
     */
    public function getVirtualWallet(): float
    {
        return $this->virtualWallet;
    }

    /**
     * @param float $virtualWallet
     */
    public function setVirtualWallet(float $virtualWallet)
    {
        $this->virtualWallet = $virtualWallet;
    }

    /**
     * @throws \Exception
     */
    public function deductVirtualWallet(float $amount)
    {
        $currentWalletValue = $this->getVirtualWallet();
        $totalAmount = $currentWalletValue - $amount;
        if ($totalAmount < 0.00){
            throw new \Exception("The investor does not have enough funds");
        }else{
            $this->setVirtualWallet($currentWalletValue - $amount);
        }
    }


}