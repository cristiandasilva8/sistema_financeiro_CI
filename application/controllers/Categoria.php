<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Categoria extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Categoria_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'categoria/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'categoria/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'categoria/index.html';
            $config['first_url'] = base_url() . 'categoria/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Categoria_model->total_rows($q);
        $categoria = $this->Categoria_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'categoria_data' => $categoria,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('categoria/categoria_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Categoria_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'nome' => $row->nome,
	    );
            $this->load->view('categoria/categoria_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('categoria'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Cadastrar',
            'action' => site_url('categoria/create_action'),
	    'id' => set_value('id'),
	    'nome' => set_value('nome'),
	);
        $this->load->view('categoria/categoria_form', $data);
    }


    public function loadView()
    {
        $data = array(
            'button' => 'Cadastrar',
            'action' => site_url('categoria/create_action'),
            'id' => set_value('id'),
            'nome' => set_value('nome'),
        );
        
        $output = array(
            'html'=>$this->load->view('categoria/categoria_form', $data, TRUE),
        );

        echo json_encode($output);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nome' => $this->input->post('nome',TRUE),
	    );

            $this->Categoria_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('categoria'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Categoria_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Atualizar',
                'action' => site_url('categoria/update_action'),
		'id' => set_value('id', $row->id),
		'nome' => set_value('nome', $row->nome),
	    );
            $this->load->view('categoria/categoria_form_update', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('categoria'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'nome' => $this->input->post('nome',TRUE),
	    );

            $this->Categoria_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('categoria'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Categoria_model->get_by_id($id);

        if ($row) {
            $this->Categoria_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('categoria'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('categoria'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nome', 'nome', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "categoria.xls";
        $judul = "categoria";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Nome");

	foreach ($this->Categoria_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nome);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Categoria.php */
/* Location: ./application/controllers/Categoria.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-01-29 23:21:50 */
/* http://harviacode.com */