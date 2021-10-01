<?php

namespace App\Dtos;

use App\User;

interface PartyDtoTypes{
    const PERSON ="person";
    const ORGANIZATION ="organization";
}

interface PartyDtoEmailAddressTypes{
    const HOME ="home";
    const WORK ="work";
}

class PartyDto{

    /** @var App\Dtos\EmailAddress */
    protected $emailAddress;

    /** @var string */
    protected $firstName;

    /**
     * PartyDto Constructor
     */
    private function __construct(){}

    /**
     * Get PartyDto Instance in array format
     * @return array
     */
    public function toArray() : array {
        return  [
            "party" => [
                    "type" => PartyDtoTypes::PERSON,
                    "emailAddresses" => [
                                            (new EmailAddress(0, PartyDtoEmailAddressTypes::WORK, $this->emailAddress->getAddress()))->toArray()
                                        ],
                    "firstName" => $this->firstName
                    ]
            ];
    }

    /**
     * Get PartyDto from user
     * @param User $user
     * @return PartyDto
     */
    public static function fromUser(User $user) : PartyDto
    {
        $partyDto = new PartyDto();
        $partyDto->setFirstname($user->name);
        $partyDto->setEmail( EmailAddress::fromArray(["type"=>PartyDtoEmailAddressTypes::WORK, "address"=>$user->email] ));
        return $partyDto;
    }

    /**
     * Get PartyDto from array
     * @param array $data
     * @return PartyDto
     */
    public static function fromArray(array $data) : PartyDto
    {
        $party = new PartyDto();
        $party->setFirstname($data["firstName"]);
        $party->setEmail(EmailAddress::fromArray($data["emailAddresses"][0]));
        return $party;
    }

    /**
     * Set firstname 
     * @param string $firstName
     * @return void
     */
    public function setFirstname(string $firstName)
    {
       $this->firstName  = $firstName;
    }

    /**
     * Get firstname 
     * @return string
     */
    public function getFirstname() : string
    {
       return $this->firstName ;
    }

    /**
     * Set email 
     * @param EmailAddress $emailAddress
     * @return void
     */
    public function setEmail(EmailAddress $emailAddress)
    {
       $this->emailAddress  = $emailAddress;
    }

    /**
     * Get email 
     * @param EmailAddress $emailAddress
     * @return EmailAddress
     */
    public function getEmail(EmailAddress $emailAddress) : EmailAddress
    {
       return $this->emailAddress;
    }

}

class EmailAddress {

    /** @var id */
    protected $id;

    /** @var string */
    protected $type;

    /** @var string */
    protected $address;

    public function  __construct(int $id, string $type, string $address){
        $this->id = $id;
        $this->type = $type;
        $this->address = $address;
    }

    /**
     * Get Email Id
     * @return int
     */
    public function getId()
    {
       return $this->id;
    }

    /**
     * Get Email Address
     * @return int
     */
    public function getAddress()
    {
       return $this->address;
    }

    /**
     * Get Email Type
     * @return int
     */
    public function getType()
    {
       return $this->type;
    }

    /**
     * Get Email In Array Format
     * @return array
     */
    public function toArray(){
        return  [
            "type" => $this->getType(),
            "address" => $this->getAddress()
        ];
    }

    /**
     * Get EmailAddress From Array
     * @return EmailAddress
     */
    public static function fromArray(array $data) : EmailAddress{
        return new EmailAddress(@$data["id"], @$data["type"], @$data["address"]);
    }

}

?>

