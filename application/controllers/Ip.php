<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ip extends CI_Controller
{

    public function index(){
        $this->v4();
    }

    public function v4(){
        #$this->output->set_content_type('application/json')->set_output(json_encode($result));
        $this->output->set_content_type('text/plain')->set_output($_SERVER['REMOTE_ADDR'] . "\n");
    }

    public function v6(){
        $this->output->set_content_type('text/plain')->set_output($_SERVER['REMOTE_ADDR'] . "\n");
    }

}