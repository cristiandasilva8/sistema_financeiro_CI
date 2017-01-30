<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('Movimentacao_model');
        $this->load->library('form_validation');
    }
	public function index()
	{

		$data = array(
				'mes' => $this->mostraMes(date('m')),
				'meses_numericos' => 12,
				);

		$this->load->view('welcome_message', $data);
	}
}
