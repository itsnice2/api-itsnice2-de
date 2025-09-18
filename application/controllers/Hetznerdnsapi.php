<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hetznerdnsapi extends CI_Controller
{

    private $database = [];
    private $table = "api_settings_itsnice2";
    private $name = "hetzner_dns_api_token";

    public function index(){
        $this->status_code();
    }

    private function set_database(){
        $this->database = array(
            'dsn'	=> '',
            'hostname' => 'hk9p.your-database.de',
            'username' => 'itsnice24u_r',
            'password' => 'LN2AthJtKVEuGrh3',
            'database' => 'testdb_itsnice2',
            'dbdriver' => 'mysqli',
            'dbprefix' => '',
            'pconnect' => FALSE,
            'db_debug' => (ENVIRONMENT !== 'production'),
            'cache_on' => FALSE,
            'cachedir' => '',
            'char_set' => 'utf8',
            'dbcollat' => 'utf8_general_ci',
            'swap_pre' => '',
            'encrypt' => FALSE,
            'compress' => FALSE,
            'stricton' => FALSE,
            'failover' => array(),
            'save_queries' => TRUE
        );
    }

    private function status_code($code = 0, $message = false){
        if(!$message){
            switch($code){
                case 200:
                    $message = "OK";
                    break;
                case 401:
                    $message = "Unauthorized";
                    break;
                case 404:
                    $message = "Not Found";
                    break;
                case 500:
                    $message = "Internal Server Error";
                    break;
                default:
                    $code = 400;
                    $message = "Bad Request\n¯\_(ツ)_/¯";
            }

            $message = json_encode(["status" => $code, "message" => $message]);
        }

        $this->output->set_status_header($code)->set_content_type('application/json')->set_output($message);

    }

    public function authentication(){

        if($auth = $this->input->get_request_header('Authorization')){

            $this->set_database();
            $this->db = $this->load->database($this->database, TRUE);

            $result = $this->db->query("SELECT `value` FROM `" . $this->table . "` WHERE name = '" . $this->name . "'");
            $api_token = $result->row()->value;
            unset($this->database);

            if($api_token == $auth){
                $_SESSION['api_token'] = $api_token;
                $this->status_code(200);
                return true;
            }
        }

        $this->status_code(401);
        return false;
    }

    public function record_get($id = false)
    {
        if($this->authentication()){
            # ScaZMeDkgJqGuNvCNGZmiE -> itsnice2.be

            if($id === false){
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://dns.hetzner.com/api/v1/records/' . $id);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    'Auth-API-Token: ' . $_SESSION['api_token'],
                ]);
                unset($_SESSION['api_token']);
                $response = curl_exec($ch);

                if (!$response) {
                    die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
                }

                curl_close($ch);
                $this->output->set_status_header(200)->set_content_type('application/json')->set_output($response);
            }
            $this->status_code(404);

        }
        else{
            $this->status_code(401);
        }
    }

    public function record_get_all($zone_id = false)
    {
        if($this->authentication()){
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://dns.hetzner.com/api/v1/records?zone_id=' . $zone_id);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Auth-API-Token: ' . $_SESSION['api_token'],
            ]);
            unset($_SESSION['api_token']);
            $response = curl_exec($ch);

            if (!$response) {
                die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
            }

            curl_close($ch);
            $this->status_code(200, $response);
            #$this->output->set_status_header(200)->set_content_type('application/json')->set_output($response);
        }
        else{
            $this->status_code(401);
        }
    }

    public function record_create()
    {
        if($this->authentication()){

        }
        else{
            $this->status_code(401);
        }
    }

    public function record_update_one($id = false, $type = false, $name = false, $value = false, $zone_id = false){
        if($this->authentication()){
            echo "ID: " . $id . " - Type: " . $type . " - Name: " . $name . " - Value: " . $value . " - Zone-ID: " . $zone_id;
        }
    }

    public function record_update_bulk(){
        if($this->authentication()){

        }
        else{
            $this->status_code(401);
        }
    }

    public function record_delete()
    {
        if($this->authentication()){

        }
        else{
            $this->status_code(401);
        }
    }

    public function record_delete_bulk()
    {
        if($this->authentication()){

        }
        else{
            $this->status_code(401);
        }
    }

    public function zone_get_all()
    {
        if($this->authentication()) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://dns.hetzner.com/api/v1/zones');
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Auth-API-Token: ' . $_SESSION['api_token'],
            ]);
            unset($_SESSION['api_token']);
            $response = curl_exec($ch);

            if (!$response) {
                $this->output->set_status_header(500);
                die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
            }

            curl_close($ch);
            $this->output->set_status_header(200)->set_content_type('application/json')->set_output($response);
        }
        else{
            $this->status_code(401);
        }
    }

    public function zone_get()
    {
        if($this->authentication()){

        }
        else{
            $this->status_code(401);
        }
    }

    public function zone_create()
    {
        if($this->authentication()){

        }
        else{
            $this->status_code(401);
        }
    }

    public function zone_update()
    {
        if($this->authentication()){

        }
        else{
            $this->status_code(401);
        }
    }

    public function zone_delete()
    {
        if($this->authentication()){

        }
        else{
            $this->status_code(401);
        }
    }

    public function zone_import_file()
    {
        if($this->authentication()){

        }
        else{
            $this->status_code(401);
        }
    }

    public function zone_export_file()
    {
        if($this->authentication()){

        }
        else{
            $this->status_code(401);
        }
    }

    public function zone_validate_file()
    {
        if($this->authentication()){

        }
        else{
            $this->status_code(401);
        }
    }

    public function primary_servers_get_all()
    {
        if($this->authentication()){

        }
        else{
            $this->status_code(401);
        }
    }

    public function primary_servers_create()
    {
        if($this->authentication()){

        }
        else{
            $this->status_code(401);
        }
    }

    public function primary_servers_get()
    {
        if($this->authentication()){

        }
        else{
            $this->status_code(401);
        }
    }

    public function primary_servers_update()
    {
        if($this->authentication()){

        }
        else{
            $this->status_code(401);
        }
    }

    public function primary_servers_delete()
    {
        if($this->authentication()){

        }
        else{
            $this->status_code(401);
        }
    }


}