
<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Intendletter extends CI_Controller {

	function __construct()
   	{
		parent::__construct();		
		$this->load->database();
        $this->load->model('Intendletter_model');
        $this->load->helper("file");
        
        error_reporting(0);
   	}

   	public function index()
	{
		$header = array('page_title'=> 'Ujwal Associates');

        $data = array(
						'heading'=>'Intend Letter',

						'createAction'=>site_url('Intendletter/create'),
						'changeAction'=>site_url('Intendletter/changeStatus'),
						'deleteAction'=>site_url('Intendletter/delete'),
					);

        $this->load->view('common/header',$header);
		$this->load->view('common/left_panel');
		$this->load->view('intendletter/list',$data);
		$this->load->view('common/footer');	
	}

	public function ajax_manage_page()
	{
        $subbranch = $this->Intendletter_model->get_datatables();

        // echo "<pre>"; print_r($data); exit();
       
        if(empty($_POST['start']))
        {
            $no =0;   
        }else{
             $no =$_POST['start'];
        }

        $data = array();        
        
        foreach ($subbranch as $row) 
        {
            // $btn = '&nbsp|&nbsp'.anchor(site_url('Pincode/delete/'.$pincode->id),'<button title="Delete" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-trash"></i></button>');
            
            // $btn = '&nbsp'.anchor(site_url('Intendletter/view/'.$row->id),'<button title="View" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-eye"></i></button>');

           
            $btn = '&nbsp|&nbsp'.anchor(site_url('Intendletter/update/'.$row->id),'<button title="Edit" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-edit"></i></button>');
            
            $btn.= '&nbsp|&nbsp'.anchor(site_url('Intendletter/print/'.$row->id),'<button title="print" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-print"></i></button>');
            
            $btn.= '&nbsp|&nbsp'.anchor(site_url('Intendletter/Openpdf/'.$row->id),'<button title="print" class="btn btn-primary btn-circle btn-xs"><i class="fa fa-print"></i></button>');
            
            $btn .= '&nbsp;|&nbsp;'.'<span data-placement="right" title="Delete"  class="btn btn-danger btn-circle btn-xs" onclick="Delete(this,'.$row->id.')"><i class="fa fa-trash"></i></span>';
            
            
            $status='';            
            if($row->status=='Active')
            {
                $status='<span class="btn btn-xs btn-success" id="statusVal'.$row->id.'"  onClick="statuss('.$row->id.');" >'.$row->status.'</span>';
            }
            else
            {
                $status='<span class="btn btn-xs btn-danger" id="statusVal'.$row->id.'"  onClick="statuss('.$row->id.');" >'.$row->status.'</span>';
            }

            $no++;
            $nestedData = array();
            $nestedData[] = $no;
            // $nestedData[] = ucwords($row->certificate_no);
            $nestedData[] = ucwords($row->name);
            // $nestedData[] = ucwords($row->city_name);
            // $nestedData[] = ucwords($row->pincode);
            // $nestedData[] = ucwords($row->location);

            $nestedData[] = $status."<input type='hidden' id='status".$row->id."' value='".$row->status."'/>";
            $nestedData[] = $btn;
            $data[] = $nestedData;
        } 

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Intendletter_model->count_all(),
                        "recordsFiltered" => $this->Intendletter_model->count_filtered(),
                        "data" => $data,
                    );
        
        echo json_encode($output);
    }
    
    public function create()
    {
        $manage_city = $this->Crud_model->GetData('cities',"","status='Active' ");
        $pincode = $this->Crud_model->GetData('cities',"","status='Active' ");

        $header = array('page_title'=>'Ujwal Associates');

        $data = array(
	        			'heading'=>'Add Intend Letter',
	                    'subheading'=>'Create Intend Letter',
	                    'button'=>'Create',
	                    'action'=>site_url('Intendletter/create_action'),
	                    
	                    'name' => '',
                        'description' => set_value('description'),
	                    'id' =>set_value('id'),
                	);

       	// echo "<pre>"; print_r($data);exit;
        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('intendletter/form',$data);
        // $this->load->view('common/footer');
    }
    
    public function create_action()
    {
        $header = array('page_title'=>'Ujwal Associates');
        
        // echo "<pre>"; print_r($_POST);// exit();
    
        $quotationdata = $this->Crud_model->GetData('intend_letter');
        if(!empty($quotationdata)){
            foreach ($quotationdata as $key) {
                $quot_id = $key->certificate_no;
            }
        }
        else
        {
            $quot_id = 1000;
        }
        
        $data = array(
                        'name' => $this->input->post('name',TRUE),
                        'description' =>$this->input->post('description'),
                        'certificate_no'=> $quot_id,
                        'created'=> date('Y-m-d H:i:s'),
                        'created_by'=> $_SESSION['SESSION_NAME']['id'],
                    );

        // echo "<pre>"; print_r($_POST);
        // echo "<pre>"; print_r($data);exit();   
        // echo "<pre>";  print_r($data); exit;
        $this->Crud_model->SaveData('intend_letter',$data);
        $this->session->set_flashdata('message', 'Letter Created Successfully');
        redirect('Intendletter');
    }

    public function update($id)
    {   
        $header = array('page_title'=>'Ujwal Associates');

        $customerData = $this->Crud_model->GetData('intend_letter',"*","id='".$id."'",'','','','1');
        // echo "<pre>"; print_r($customerData); exit();
        
        $data = array(
                        'heading'=>'Update Intend Letter',
                        'subheading'=>'Update Intend Letter',
                        'button'=>'Update',
                        'action'=>site_url('Intendletter/update_action'),

                        'name' => $customerData->name,
                        'description' => $customerData->description,
	                    
                        'id' =>$id,
                    );
        // echo "<pre>"; print_r($data); exit();

        $this->load->view('common/header',$header);
        $this->load->view('common/left_panel');
        $this->load->view('intendletter/form',$data);
        // $this->load->view('common/footer'); 
    }

    public function update_action()
    {
    	$id = $_POST['id'];

        $data = array(
                        'name' => $this->input->post('name',TRUE),
                        'description' =>$this->input->post('description'),
                        'modified'=> date('Y-m-d H:i:s'),
                    );

        // echo "<pre>"; print_r($_POST); // exit();
        // echo "<pre>"; print_r($data);
        // exit;
            
        $this->Crud_model->SaveData('intend_letter',$data,"id='".$id."'");
        $this->session->set_flashdata('message', 'Data Updated successfully');
        redirect(site_url('Intendletter'));              
    }
    
    public function delete()
    {
    // 	echo "<pre>"; print_r($_POST); exit();
        $this->Crud_model->DeleteData('intend_letter',"id='".$_POST['cid']."'");
    // 	redirect('Subbranch');
    }
    
    public function change_status()
    {
    // 	echo "<pre>"; print_r($_POST); exit();
        if(isset($_POST['statusupdate']))
        {
            $this->Crud_model->SaveData("intend_letter",$_POST,"id='".$_POST['id']."'");exit;
        }
    }
    
    public function print($id, $pdf='')
    {
        $customerData = $this->Crud_model->get_single('intend_letter',"id='".$id."'");
        
        $settings = $this->Crud_model->GetData('settings','','','','','','1');

        $data2=array(
                        'settings' =>$settings,
                        'customerData' => $customerData,
                );
        
        // echo "<pre>"; print_r($data2); exit;
        
        if(!empty($pdf))
        {
            return $this->load->view('intendletter/print',$data2, true);
        }
        else
        {
            $this->load->view('intendletter/print',$data2);
        }
    }
    
    public function Openpdf($id)
    {
        $pdf="pdf";
        // $body_pdf = $this->create_print_pdf($id);
        $body_pdf = $this->print($id, $pdf);
        
        // echo "<pre>"; print_r($body_pdf); exit;

        $pnlname = date('d-m-Y'); 
        $rand=rand(0000,9999);
        $pnlname1 = date('d-m-Y').'_'.time(); 
        $fileName = '/uploads/quotation/'.$pnlname.'_wpes_'.$rand.'.pdf';

        $file = getcwd().$fileName;
        $pdfFilePath = $file;
        $this->load->library('m_pdf');
        
        ///////////////////////////WATERMARK CODE//////////////////////////////////////////////////
        $mpdf=new mPDF('c');
        
          $mpdf->SetDisplayMode('fullpage');
        //   $mpdf->SetWatermarkText('World Planet Technologies pvt.ltd.');
          $mpdf->SetWatermarkImage(base_url('uploads/logo/logo1.jpg'),0.1,'F','F');
          $mpdf->showWatermarkImage = true;
          $mpdf->img_dpi = 10;
          $mpdf->watermark_font = 'DejaVuSansCondensed';
        //   $mpdf->watermarkTextAlpha = 0.1;
        //   $mpdf->showWatermarkText = true;
        ///////////////////////WATERMARK CODE//////////////////////////////////////////////////////
        ///////////////////////PAGE NUMBER///////////////////////////////////////////////////
        
              $mpdf->mirrorMargins = 1;
              $mpdf->defaultPageNumStyle = '1';
              $mpdf->SetDisplayMode('fullpage','two');
            ///////////////////////PAGE NUMBER///////////////////////////////////////////////////
            $mpdf->defaultfooterfontsize = 12;  /* in pts */
            $mpdf->defaultfooterfontstyle = B;  /* blank, B, I, or BI */
            $mpdf->defaultfooterline = 0;       /* 1 to include line below header/above footer */
            $mpdf->SetHTMLFooter('<div style="text-align: center;">{PAGENO}</div>','O'); /* defines footer for Odd and Even Pages - placed at Outer margin */
            $mpdf->SetHTMLFooter('<div style="text-align: center;">{PAGENO}</div>','E'); /* defines footer for Odd and Even Pages - placed at Outer margin */
             $body =  $mpdf->WriteHTML($body_pdf);
               
            $mpdf->SetDisplayMode('fullpage');
            //download it D save F.
            fopen($pdfFilePath,'wb');
            $mpdf->Output($pdfFilePath, "D");
            $mpdf->Output($pdfFilePath, "F");
            
            //echo "Hi";
          

        redirect(site_url('Intendletter'));
    }
    
    

}?>