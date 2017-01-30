<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Movimentacao extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Movimentacao_model');
        $this->load->model('Categoria_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'movimentacao/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'movimentacao/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'movimentacao/index.html';
            $config['first_url'] = base_url() . 'movimentacao/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Movimentacao_model->total_rows($q);
        $movimentacao = $this->Movimentacao_model->getMovimentacao($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'movimentacao_data' => $movimentacao,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('movimentacao/movimentacao_list', $data);
    }



    public function loadView()
    {
        $categorias = $this->Categoria_model->get_all();
        $data = array(
            'button' => 'Cadastrar',
            'action' => site_url('movimentacao/create_action'),
            'id' => set_value('id'),
            'tipo' => set_value('tipo_receita'),
            'data' => set_value('data'),
            'cat' => set_value('cat'),
            'categoria' => $categorias,
            'descricao' => set_value('descricao'),
            'valor' => set_value('valor'),
        );
        

        $output = array(
            'html'=>$this->load->view('movimentacao/movimentacao_form', $data, TRUE),
        );

        echo json_encode($output);
    }

    public function read($id) 
    {
        $row = $this->Movimentacao_model->get_by_id($id);
        if ($row) {
            $data = array(
        		'id' => $row->id,
        		'tipo' => $row->tipo,
        		'dia' => $row->dia,
        		'mes' => $row->mes,
        		'ano' => $row->ano,
        		'cat' => $row->cat,
        		'descricao' => $row->descricao,
        		'valor' => $row->valor,
	        );
            $this->load->view('movimentacao/movimentacao_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('movimentacao'));
        }
    }

    public function create() 
    {
        $categorias = $this->Categoria_model->get_all();
        $data = array(
            'button' => 'Cadastrar',
            'action' => site_url('movimentacao/create_action'),
    	    'id' => set_value('id'),
    	    'tipo' => set_value('tipo_receita'),
    	    'data' => set_value('data'),
            'cat' => set_value('cat'),
            'categoria' => $categorias,
    	    'descricao' => set_value('descricao'),
    	    'valor' => set_value('valor'),
	);
        $this->load->view('movimentacao/movimentacao_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();
        $date = $this->input->post('data',TRUE);

        $explode = $this->_inverteDataDB($date);
        $explode = date("Y-m-d", strtotime($explode));

        $arrayData = explode("-",$explode);
        
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
        		'tipo' => $this->input->post('tipo',TRUE),
        		'dia' => $arrayData[2],
        		'mes' => $arrayData[1],
        		'ano' => $arrayData[0],
        		'cat' => $this->input->post('cat',TRUE),
        		'descricao' => $this->input->post('descricao',TRUE),
        		'valor' => $this->input->post('valor',TRUE),
	        );

            $this->Movimentacao_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('movimentacao'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Movimentacao_model->get_by_id($id);
        $categorias = $this->Categoria_model->get_all();
        if ($row) {
            $date = $row->ano . "-" . $row->mes . "-" . $row->dia;
            $data = array(
                'button' => 'Atualizar',
                'action' => site_url('movimentacao/update_action'),
        		'id' => set_value('id', $row->id),
        		'tipo' => set_value('tipo_receita', $row->tipo),
        		'data' => $date,
        		'cat' => set_value('cat', $row->cat),
                'categoria' => $categorias,
        		'descricao' => set_value('descricao', $row->descricao),
        		'valor' => set_value('valor', $row->valor),
	    );
      
            $this->load->view('movimentacao/movimentacao_form_update', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('movimentacao'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        $date = $this->input->post('data',TRUE);

        $arrayData = explode("-",$date);

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
        		'tipo' => $this->input->post('tipo_receita',TRUE),
        		'dia' => $arrayData[2],
        		'mes' => $arrayData[1],
        		'ano' => $arrayData[0],
        		'cat' => $this->input->post('cat',TRUE),
        		'descricao' => $this->input->post('descricao',TRUE),
        		'valor' => $this->input->post('valor',TRUE),
	        );

            $this->Movimentacao_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('movimentacao'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Movimentacao_model->get_by_id($id);

        if ($row) {
            $this->Movimentacao_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('movimentacao'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('movimentacao'));
        }
    }

    public function SomaValor(){
        $status = null;
        $valor = $this->input->post("valor");
        $mes = $this->input->post("mes");
        $ano = $this->input->post("ano");

        $total  = $this->Movimentacao_model->soma_valor($valor, $mes, $ano);

        $total = ($total[0]->total == null) ? 0 : $total[0]->total;

        $totalEntradas = $this->Movimentacao_model->soma_valor(1, $mes, $ano);
        $totalSaidas = $this->Movimentacao_model->soma_valor(0, $mes, $ano);

        $resultado_mes = ($totalEntradas[0]->total - $totalSaidas[0]->total);

        $resultado_mes = ($resultado_mes == null) ? 0 : $resultado_mes;

        if($totalEntradas[0]->total > $totalSaidas[0]->total){
            $status = 'text-success';
        }else if($totalEntradas[0]->total < $totalSaidas[0]->total){
            $status = 'text-danger';
        }

        $dados = array(
            'total' => $this->formata_dinheiro($total),
            'resultado_mes' => $this->formata_dinheiro($resultado_mes),
            'status' => $status,
            );
        echo json_encode($dados);
    }

    public function SomaValorTotal(){
        $status = null;
        $valor = $this->input->post("valor");
        $ano = $this->input->post("ano");

        $total  = $this->Movimentacao_model->soma_movimentacao_total($valor, $ano);

        $total = ($total[0]->soma_total == null) ? 0 : $total[0]->soma_total;

        $totalEntradas = $this->Movimentacao_model->soma_movimentacao_total(1, $ano);
        $totalSaidas = $this->Movimentacao_model->soma_movimentacao_total(0, $ano);

        $resultado_geral = ($totalEntradas[0]->soma_total - $totalSaidas[0]->soma_total);

        $resultado_geral = ($resultado_geral == null) ? 0 : $resultado_geral;

        if($totalEntradas[0]->soma_total > $totalSaidas[0]->soma_total){
            $status = 'text-success';
        }else if($totalEntradas[0]->soma_total < $totalSaidas[0]->soma_total){
            $status = 'text-danger';
        }

        $dados = array(
            'soma_total' => $this->formata_dinheiro($total),
            'resultado_geral' => $this->formata_dinheiro($resultado_geral),
            'status' => $status,
            'ano' => $ano
            );
        echo json_encode($dados);
    }

    public function _rules() 
    {
        $this->form_validation->set_rules('data', 'data', 'trim|required');
	$this->form_validation->set_rules('cat', 'cat', 'trim|required');
	$this->form_validation->set_rules('descricao', 'descricao', 'trim|required');
	$this->form_validation->set_rules('valor', 'valor', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "movimentacao.xls";
        $judul = "movimentacao";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Tipo");
	xlsWriteLabel($tablehead, $kolomhead++, "Dia");
	xlsWriteLabel($tablehead, $kolomhead++, "Mes");
	xlsWriteLabel($tablehead, $kolomhead++, "Ano");
	xlsWriteLabel($tablehead, $kolomhead++, "Cat");
	xlsWriteLabel($tablehead, $kolomhead++, "Descricao");
	xlsWriteLabel($tablehead, $kolomhead++, "Valor");

	foreach ($this->Movimentacao_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->tipo);
	    xlsWriteNumber($tablebody, $kolombody++, $data->dia);
	    xlsWriteNumber($tablebody, $kolombody++, $data->mes);
	    xlsWriteNumber($tablebody, $kolombody++, $data->ano);
	    xlsWriteNumber($tablebody, $kolombody++, $data->cat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->descricao);
	    xlsWriteLabel($tablebody, $kolombody++, $data->valor);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Movimentacao.php */
/* Location: ./application/controllers/Movimentacao.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-01-29 23:21:51 */
/* http://harviacode.com */