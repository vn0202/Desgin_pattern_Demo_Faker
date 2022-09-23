<?php

namespace Vannghia\DesignPattern;

use Faker\Factory;

class Data
{
    protected $faker;

    public function __construct(string $locale = 'en_US')
    {
        $this->faker = Factory::create($locale);//set locale by en_US
    }


    public function createInforPerson()
    {
        $infor = [];
        $infor['firstName'] = $this->faker->firstName();
        $infor['lastName'] = $this->faker->lastName();
        $infor['address'] = $this->faker->address();
        $infor['phone'] = $this->faker->phoneNumber();
        $infor['email'] = $this->faker->email();


        return $infor;
    }

    public function setSameVaule()
    {
        $this->faker->seed(1);

    }

    public function setAutoValue()
    {
        $this->faker->seed(null);
    }

    // set unique to recieve a unique value
    public function modifierUnique()
    {
        $values = [];
        try {
            for ($i = 0; $i < 11; $i++) {
                $values[] = $this->faker->unique()->randomDigit();
            }
        } catch (\Exception $exception) {
            throw new  \Exception('only has 10  unique digits without null ');

        }
    }
//get firstname with the probabilty of $default's appperance is
      public  function  modifierOptionalFirstName(float $weight, string $default = "Vu" ){
        return $this->faker->optional($weight,$default)->firstName();
      }
      //get last name follow what you want it starts with any character.
      public  function  modifierValidLastName($callback){

        return $this->faker->valid($callback)->lastName();
      }
}