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

    public function authentication(){

        if($auth = $this->input->get_request_header('Authorization')){
            $config['dsn']      = '';
            $config['hostname'] = $this->HOST;
            $config['username'] = $this->USER;
            $config['password'] = $this->PW;
            $config['database'] = $this->DB;
            $config['dbdriver'] = 'mysqli';
            $config['dbprefix'] = '';
            $config['pconnect'] = FALSE;
            $config['db_debug'] = (ENVIRONMENT !== 'production');
            $config['cache_on'] = FALSE;
            $config['char_set'] = 'utf8';
            $config['dbcollat'] = 'utf8_general_ci';
            $config['swap_pre'] = '';
            $config['encrypt']  = FALSE;
            $config['compress'] = FALSE;
            $config['stricton'] = FALSE;
            $config['failover'] = array();
            $config['save_queries'] = TRUE;

            $this->db = $this->load->database($config, TRUE);

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