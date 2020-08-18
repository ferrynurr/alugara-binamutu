<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Load library phpspreadsheet
require('./excel/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
// End load library phpspreadsheet


class Upi extends CI_Controller {

  public function __construct()
     {
         parent::__construct();
         if($this->session->userdata('status') == null) {
            
            redirect('auth');
           }
            $this->load->model('m_upi','upi');
            

     }

    public function index()
    {
      $data = array('header_judul'  => 'Data UPI',
                    'data_upij'     => $this->upi->get_upiJenis(),
                    'upij_selected' => '',
                     'data_upi'     => $this->upi->data_pdf(),
                    'upi_selected' => ''
              );

     $this->load->view('v_upi', $data);

    }


  public function ajax_list()
    	{

    		$list = $this->upi->get_datatables();
    		$data = array();
    		$no = $_POST['start'];
    		foreach ($list as $field) {
    			$no++;
    			$row = array();

          $row[] = $no;
    			$row[] = $field->nama_upi;
    		  $row[] = $field->alamat;
          $row[] = $field->no_telp;
          $row[] = $field->email;
          $row[] = $field->nama_upi_jenis;
          $row[] = $field->skala;
          $row[] = $field->peringkat;
          $row[] = '<a class="btn btn-sm btn-info" href="javascript:void()" title="Detail UPI" onclick="view_dtupi('."'".$field->id_upi."'".')">Detail<i class="fa fa-angle-double-down" aria-hidden="true"></i></a>';

    			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_data('."'".$field->id_upi."'".')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
    				  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_data('."'".$field->id_upi."'".')"><i class="glyphicon glyphicon-trash"></i></a>';

    			$data[] = $row;
    		}

    		$output = array(
    						"draw" => $_POST['draw'],
    						"recordsTotal" => $this->upi->count_all(),
    						"recordsFiltered" => $this->upi->count_filtered(),
    						"data" => $data,
    				);
    		//output to json format
    		echo json_encode($output);
    	}

  public function ajax_add()  // add produk
        {

            $data = array(
                    'nama_upi' => $this->input->post('nama_upi'),
                    'alamat' => $this->input->post('alamat'),
                     'no_telp' => $this->input->post('no_telp'),
                    'email' => $this->input->post('email'),
                    'id_upi_jenis' => $this->input->post('id_upi_jenis'),
                    'skala' => $this->input->post('skala'),
                    'peringkat' => $this->input->post('peringkat'),
                     'kapasitas_produksi' => $this->input->post('kapasitas_produksi'),
                    'realisasi_produksi' => $this->input->post('realisasi_produksi'),
                    'banyak_coldstorage' => $this->input->post('banyak_coldstorage'),
                    'kapasitas_coldstorage' => $this->input->post('kapasitas_coldstorage'),
                    'jumlah_pgl' => $this->input->post('jumlah_pgl'),
                     'jumlah_pgp' => $this->input->post('jumlah_pgp')

                );

                  $insert = $this->upi->save($data);
                  echo json_encode(array("status" => TRUE));
        }

  public function ajax_add_jupi()  // add produk
        {

            $data['nama_upi_jenis'] = $this->input->post('nama_upi_jenis2');
                    
             $insert = $this->upi->save2($data);
             echo json_encode(array("status" => TRUE));
        }

  public function ajax_delete($id)
         {
             $this->upi->delete_by_id($id);
             echo json_encode(array("status" => TRUE));
         }

   public function ajax_view($id)
          {
                    $data = $this->upi->get_by_id($id);
                    echo json_encode($data);
          }

    public function ajax_update()
           {
                       
               $data = array(
                    'nama_upi' => $this->input->post('nama_upi'),
                    'alamat' => $this->input->post('alamat'),
                     'no_telp' => $this->input->post('no_telp'),
                    'email' => $this->input->post('email'),
                    'id_upi_jenis' => $this->input->post('id_upi_jenis'),
                     'skala' => $this->input->post('skala'),
                    'peringkat' => $this->input->post('peringkat'),
                     'kapasitas_produksi' => $this->input->post('kapasitas_produksi'),
                    'realisasi_produksi' => $this->input->post('realisasi_produksi'),
                     'banyak_coldstorage' => $this->input->post('banyak_coldstorage'),
                    'kapasitas_coldstorage' => $this->input->post('kapasitas_coldstorage'),
                    'jumlah_pgl' => $this->input->post('jumlah_pgl'),
                     'jumlah_pgp' => $this->input->post('jumlah_pgp')
                    

                );
                
                 $this->upi->update(array('id_upi' => $this->input->post('id_upi')), $data);
                 echo json_encode(array("status" => TRUE));

           }

function cetak_pdf()
     {

            $this->load->library('dompdf_gen');
            $id_upi = $this->input->post('id_upi_ctk');
            $data = array(
                                'data_pdf' => $this->upi->get_data_upi($id_upi),                    
                          );

                     $this->load->view('pdf/upi_pdf', $data);

                     $paper_size  = 'A4'; //paper size
                     $orientation = 'landscape'; //tipe format kertas
                     $html = $this->output->get_output();

                     $this->dompdf->set_paper($paper_size, $orientation);
                     //Convert to PDF
                     $this->dompdf->load_html($html);
                     $this->dompdf->render();
                     $this->dompdf->stream("Data_UPI_".time().".pdf", array('Attachment'=>0));
   }

public function download()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Hello World !');
        
        $writer = new Xlsx($spreadsheet);
 
        $filename = 'name-of-the-generated-file';
 
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output'); // download file 
 
    }

 function cetak_excel()
    {
     

        $id_upi =  $this->input->post('id_upi_ctk');
        $data = $this->upi->get_data_upi($id_upi);
        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();

        // Set document properties
        $spreadsheet->getProperties()->setCreator('BINAMUTU-DKP JATIM')
        ->setTitle('Laporan UPI')
        ->setSubject('Office 2007 XLSX Test Document')
        ->setDescription('Laporan UPI, generated using PHP classes.');

        // set align center
        $spreadsheet->getActiveSheet()->getStyle('A:H')->getAlignment()->setHorizontal('center');   

        // set auto size
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);

        //set font BOLD
        $spreadsheet->getActiveSheet()->getStyle("A4:H4")->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->getStyle("D1:D2")->getFont()->setBold(true);



        // Add some data
        $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('D1', 'LAPORAN DATA UPI')
        ->setCellValue('D2', 'BINAMUTU -  DINAS KELAUTAN DAN PERIKANAN JAWA TIMUR')
        ->setCellValue('A4', 'NO')
        ->setCellValue('B4', 'NAMA')
        ->setCellValue('C4', 'ALAMAT')
        ->setCellValue('D4', 'NO.TELPON')
        ->setCellValue('E4', 'EMAIL')
        ->setCellValue('F4', 'JENIS UPI')
        ->setCellValue('G4', 'GRADE')
        ->setCellValue('H4', 'SKALA')
        ;

        // Miscellaneous glyphs, UTF-8
        $i=5; 
        $no = 1;
        foreach($data as $row) {
            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, $no)
            ->setCellValue('B'.$i, $row->nama_upi)
            ->setCellValue('C'.$i, $row->alamat)
            ->setCellValue('D'.$i, $row->no_telp)
            ->setCellValue('E'.$i, $row->email)
            ->setCellValue('F'.$i, $row->nama_upi_jenis)
            ->setCellValue('G'.$i, $row->peringkat)
            ->setCellValue('H'.$i, $row->skala);
            
            $no++;
            $i++;
        }

        // Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('LAPORAN DATA UPI  '.date("F-Y").'');

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);

        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="['.date("F/Y").']Laporan_Data_UPI_App_Binamutu_'.time().'.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
       // header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
   }


}
