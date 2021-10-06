<?php
class InvoiceController extends CI_Controller {

	public function __construct() {

		parent::__construct();
		
		if (!$this->session->userdata('log_in')) {
			$this->session->set_flashdata('errorMessage','<div class="alert alert-danger">Login Is Required</div>');
			redirect(base_url('login'));
		}
	}
 

	public function index () {
	 	$this->load->database();
		$data['invoices'] = $this->db->order_by('id','DESC')->get('invoice')->result();
        $data['log_categories'] = $this->db->get('categories')->result();
		$data['content'] = "invoice/index";
		$this->load->view('master',$data);
		 
	}

    public function find() {
		$this->load->database();
		$id = $this->input->post('id');
		$invoice = $this->db->where('id', $id)->get('invoice')->row();
		echo json_encode($invoice);
	}

    public function update() {
		$this->load->database();

		$data = $this->input->post('invoice'); 

		$this->db->where('id',$this->input->post('id'))->update('invoice', $data);

		$this->session->set_flashdata('successMessage', '<div class="alert alert-success">Supplier Updated</div>');

		return redirect('invoice');
	}


    public function insert(){
        $this->load->database();
        $invoice = $this->input->post('invoice');

        $this->db->insert('invoice' , $invoice);
        return redirect('invoice');
    }

    public function destroy($id) {
		$this->db->where('id', $id)->delete('invoice');
		if ($this->db->error()['code'] === 1451) {
			$this->session->set_flashdata('error', 'Cannot delete this supplier. There is an item associated with this supplier.');
		}

		return redirect('invoice');
	}

    public function export($id){
        $this->load->library('pdfreport');
		$orientation = 'portrait';
		$paper = 'A4';
		$file_name = 'invoice.pdf';

		$invoice = $this->db->where('id', $id)->get('invoice')->result();
		$data['content'] = 'invoice/pdf';
		$data['invoice'] = $invoice;
		// var_dump($invoice);
		// die;
		$template = $this->load->view('invoice/pdf', $data, true);
		$this->pdfreport->generate($template, $file_name, $paper, $orientation );
    }


	public function pdfTemplate($invoices){
		return "
			 <table>
				<thead>
					<tr>
						<td>
							Nomor Invoice
						</td>
						<td>
							Supplier
						</td>
						<td>
							Jumlah Batang Kayu
						</td>
						<td>
							Jenis Kayu
						</td>
						<td>
							Jumlah Volume
						</td>
						<td>
							Total Pembayaran
						</td>
					</tr>
				</thead>
				<tbody>
				".
					 
				"</tbody>
			</table>
		";
	}
	
}
?>