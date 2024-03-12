<?php
class UserT
{
    private $user_id = 1;
    private $user_full_name;
    private $user_phone;
    private $user_email;
    private $user_section;
    private $user_cabinet;
    private $user_is_staff = 0;


    // public function __construct(, $user_name, $user_last_name, $user_midlle_name, $user_phone, $user_email, $user_section, $user_cabinet, $user_is_staff) {
    //     // Доступ к эземпляру класса с помощью $this
    //     $this->user_id = $user_id;
    //     $this->user_name =
    // }

    // Методы объявляются как функции принадлежащие классу
    public function setFullName($user_full_name)
    {
        $this->user_full_name = $user_full_name;
    }
    public function getFullName()
    {
        return $this->user_full_name;
    }

    public function setPhone($user_phone)
    {
        $this->user_phone = $user_phone;
    }

    public function setEmail($user_email)
    {
        $this->user_email = $user_email;
    }

    public function setSection($user_section)
    {
        $this->user_section = $user_section;
    }

    public function setCabinet($user_cabinet)
    {
        $this->user_cabinet = $user_cabinet;
    }

    private function setIsStaff()
    {
        $this->user_is_staff = 0;
    }

    public function checkPropNotNull()
    {
        foreach (get_object_vars($this) as $key => $value) {
            if(!(isset($value))){
            return false;
            }
        }
        return true;
    }

    private function insertToDb()
    {
        $conn = new Connection();
        $connect_db = $conn->open();

    }


}
?>