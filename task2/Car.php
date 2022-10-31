<?php

abstract class CarDetail {

    protected  $isBroken;
    protected  $isPaintingDamaged;
    protected  $isTyreDamaged;

    public function __construct(bool $isBroken, bool $isPaintingDamaged = false, bool $isTyreDamaged = false)
    {
        $this->isBroken = $isBroken;
        $this->isPaintingDamaged = $isPaintingDamaged;
        $this->isTyreDamaged = $isTyreDamaged;
    }

    /**
     * Here we are set the any broken in the car
     */
    public function isBroken(): bool
    {
        return $this->isBroken;
    }

    /**
     * Here we are set any damage in external of the car
     */
    public function isPaintingDamaged(): bool
    {
        return $this->isPaintingDamaged;
    }
    
    /**
     * Here we are set the any damage in tyre
     */
    public function isTyreDamaged(): bool
    {
        return $this->isTyreDamaged;
    }

}

class Door extends CarDetail
{
  
}

class Tyre extends CarDetail
{

    // public function isDamaged()
    // {
    //     $isDamaged = $this->isTyreDamaged();
       
    //     if($isDamaged){
    //         return "Car Tyre is Damaged !";
    //     }else{
    //         return "Car Tyre is Good !";
    //     }
    // }

}

class Car
{

    /**
     * @var CarDetail[]
     */
    private $details;

    /**
     * @param CarDetail[] $details
     */
    
     public function __construct(array $details)
    {
        $this->details = $details;
    }
    /**
     * Check the car status with broken
     */
    public function isBroken(): string
    {
        $isBroken = $this->isDamage('isBroken');

        if($isBroken){
            return "Car is Broken !";
        }else{
            return "Car is not Broken !";
        }
    }
    /**
     * Check the car painting is damage or not
     */
    public function isPaintingDamaged(): string
    {
        $isDamaged = $this->isDamage('isPaintingDamaged');
       
        if($isDamaged){
            return "Car Painting is Damaged !";
        }else{
            return "Car Painting is Good !";
        }
    }

    /**
     * Check the car tyre is damage or not.
     */
    public function isTyreDamaged(): string
    {
        $isDamaged = $this->isDamage('isTyreDamaged');
       
        if($isDamaged){
            return "Car Tyre is Damaged !";
        }else{
            return "Car Tyre is Good !";
        }
    }
    /**
     * This function evaluate the condition based on what is set into the constructor and provide the
     * response to the method based on the method name.
     */
    private function isDamage(string $damage_name):string
    {
        foreach ($this->details as $detail) {

            if ($detail->$damage_name()) {
                return true;
            }
        }

        return false;
    }
}

$car = new Car([new Door(false , true), new Tyre(true ,false, true)]);

echo $car->isBroken();
echo "<br />";
echo $car->isPaintingDamaged();
echo "<br />";
echo $car->isTyreDamaged();

/**
 * Note: We can also implement the concept Making the function into the Tyre and Door classes, Now only implemention
 *  with Car Class. For sample I make the function in tyre class and comment it.we can use it by the Tyre clas same for 
 * we can do for the Door class
 */
