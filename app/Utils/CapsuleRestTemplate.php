<?php

namespace App\Utils;

use App\Dtos\PartyDto;
use App\User;
use GuzzleHttp\Exception\RequestException;
use App\Exceptions\CapsuleCrmException;

class CapsuleRestTemplate {

    /** @var string */
    protected const CREATE_PARTY_URL_PATH = "parties";

    /** @var string */
    protected $capsuleBaseUrl;

    /** @var string */
    protected $apiToken;

    /** @var GuzzleHttp\Client */
    protected $httpClient;

    public function __construct(string $apiToken, string $capsuleBaseUrl)
    {
        $this->apiToken = $apiToken;
        $this->capsuleBaseUrl = $capsuleBaseUrl;
        $this->httpClient = app()->make("HttpClient"); 
    }

    /**
     * To create a party on capsule crm using post request method
     * @param PartyDto $partyDto the party data to object instance
     * @return PartyDto
     * @throws CapsuleCrmException
     */
    public function post(PartyDto $partyDto) : PartyDto {
        try{
            $response = $this->httpClient->request('POST', $this->capsuleBaseUrl . CapsuleRestTemplate::CREATE_PARTY_URL_PATH,[
                        'headers' => [
                            'Authorization' => 'Bearer '. $this->apiToken,
                            'Content-Type' => "application/json",
                            'Accept' => "application/json",
                        ],
                        "body" => json_encode($partyDto->toArray())
            ]);

            $body = $response->getBody()->getContents();
            return PartyDto::fromArray(json_decode($body, true)["party"]);
        }catch(RequestException $e){
            \Log::info($e->getMessage());
            throw new CapsuleCrmException("An Error Occured while creating a party on capsule crm.");
        }
    }

}

?>

