<?php

namespace App\Models;

class User extends Model
{
    protected $id;
    protected $last_name;
    protected $first_name;
    protected $address;
    protected $zip_code;
    protected $city;
    protected $mobile;



    /**
     * Constructeur
     *
     * @param [type] $first_name
     * @param [type] $last_name
     * @param [type] $address
     * @param [type] $zip_code
     * @param [type] $city
     * @param $mobile
     */
    public function __construct($id= null, $first_name = null,$last_name = null ,$address = null, $zip_code=null, $city=null , $mobile = null)
    {
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->address = $address;
        $this->zip_code = $zip_code;
        $this->city = $city;
        $this->mobile = $mobile;


        //Insertions des données dans le tableau params
        $params = [
            'id'=>$id,
            'firstname' => $first_name,
            'lastname' => $last_name,
            'address' => $address,
            'zip_code' => $zip_code,
            'city' =>$city,
            'mobile' => $mobile,
        ];

        parent::__construct('user_u', $params);
    }


}
