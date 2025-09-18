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

    public function homelab(){
        $config['dsn']      = '';
        $config['hostname'] = "sql299.your-server.de";
        $config['username'] = "client01";
        $config['password'] = "YUMh9H49gQ3Cw2CJ";
        $config['database'] = "db_fuer_sonstiges";
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

        $result = $this->db->query("SELECT `value`, `last_update` FROM `homelab_config` WHERE `name` = 'public_ip'");
        $public_ip = $result->row()->value;
        $time = $result->row()->last_update;


        $this->output->set_status_header(200)->set_content_type("text/plain")->set_output("Public IP:\t" . $public_ip . "\nLast Update:\t" . $time . "\n");
    }

}