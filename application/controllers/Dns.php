<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dns extends CI_Controller
{

    private $DB     = "testdb_itsnice2";
    private $HOST   = "hk9p.your-database.de";
    private $USER   = "itsnice24u_r";
    private $PW     = "LN2AthJtKVEuGrh3";



    public function index(){
        $this->output->set_content_type('text/plain')->set_output("¯\_(ツ)_/¯");
    }

    private function set_database(){
        $db['testdb_itsnice2'] = array(
            'dsn'	        => '',
            'hostname'      => 'hk9p.your-database.de',
            'username'      => 'itsnice24u_r',
            'password'      => 'LN2AthJtKVEuGrh3',
            'database'      => 'testdb_itsnice2',
            'dbdriver'      => 'mysqli',
            'dbprefix'      => '',
            'pconnect'      => FALSE,
            'db_debug'      => (ENVIRONMENT !== 'production'),
            'cache_on'      => FALSE,
            'cachedir'      => '',
            'char_set'      => 'utf8',
            'dbcollat'      => 'utf8_general_ci',
            'swap_pre'      => '',
            'encrypt'       => FALSE,
            'compress'      => FALSE,
            'stricton'      => FALSE,
            'failover'      => array(),
            'save_queries'  => TRUE
        );

        return $db;
    }

    public function authentication(){

        if($auth = $this->input->get_request_header('Authorization')){

            $this->db = $this->load->database($this->set_database(), TRUE);

            $result = $this->db->query("SELECT value FROM `api_settings_itsnice2` WHERE name = 'hetzner_dns_api_token'");
            $api_token = $result->row()->value;

            if($api_token == $auth){
                $this->output->set_status_header(200);
                return true;
            }
        }

        $this->output->set_status_header(401);
        return false;
    }

    public function record_get()
    {

    }

    public function record_get_all()
    {

    }

    public function record_create()
    {

    }

    public function record_update_one($id = false, $type = false, $name = false, $value = false, $zone_id = false){
        if($this->authentication()){
            echo "ID: " . $id . " - Type: " . $type . " - Name: " . $name . " - Value: " . $value . " - Zone-ID: " . $zone_id;
        }
    }

    public function record_update_bulk(){
        if($this->authentication()){

        }
    }

    public function record_delete()
    {

    }

    public function record_delete_bulk()
    {

    }


}