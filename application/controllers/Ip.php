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

    public function homelab($update = false){
        $this->db = $this->load->database('db_fuer_sonstiges', TRUE);

        $result = $this->db->query("SELECT `value`, `last_update` FROM `homelab_config` WHERE `name` = 'public_ip'");
        $public_ip = $result->row()->value;

        if($update){
            $time = "\n" . $result->row()->last_update;
        }
        else{
            $time = "";
        }



        $this->output->set_status_header(200)->set_content_type("text/plain")->set_output($public_ip . $time . "\n");
    }

}