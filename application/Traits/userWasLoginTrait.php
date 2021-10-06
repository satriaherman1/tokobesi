<?php

namespace application\Traits;

    trait userWasLoginTrait{
        public function showAlertDidLogin(){
            if($this->session->flashdata('successMessage')){
                echo $this->session->flashdata('successMessage');
                $this->session->unset_userdata('successMessage');
                $this->session->unset_userdata('errorMessage');
            }
            else{
                echo $this->session->flashdata('errorMessage');
                $this->session->unset_userdata('errorMessage');
            }
        }
    }
?>