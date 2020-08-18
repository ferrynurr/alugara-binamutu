<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Load library phpspreadsheet
require('./excel/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
// End load library phpspreadsheet


class Laporan extends CI_Controller {

  public function __construct()
     {
         parent::__construct();
         if($this->session->userdata('status') == null) {
            
            redirect('auth');
           }
            $this->load->model('m_upi','upi');
            $this->load->model('m_produk','prod');
            $this->load->model('m_skp','skp');
            $this->load->library('Dompdf_gen');
            

     }

 function lap_skp()
 {
    $tipe = $this->uri->segment(2);
    $data = array();
    $input = $this->input->post('rd_skp');

    if($tipe == 'pdf'){
          $data = array('data_pdf' => $this->skp->get_data_skp($input)               
                       );
          if($input == 'skp_habis'){
               $data['judul'] = 'LAPORAN DATA SKP HABIS';

             }elseif ($input == 'skp_akan_habis') {
               $data['judul'] = 'LAPORAN DATA SKP AKAN HABIS';
            }

         $this->load->view('pdf/skp_pdf', $data);

         $paper_size  = 'A4'; //paper size
         $orientation = 'landscape'; //tipe format kertas
         $html = $this->output->get_output();

         $this->dompdf->set_paper($paper_size, $orientation);
         //Convert to PDF
         $this->dompdf->load_html($html);
         $this->dompdf->render();
         $this->dompdf->stream("Data_SKP_".$data['judul']."_".time().".pdf", array('Attachment'=>0));

    }elseif ($tipe == 'excel') {
      
    }
 }    



function pdf()
{
     $data = array('header_judul'  => 'Laporan PDF',
                   'data_produk'    => $this->prod->get_produk(),
                   'data_upi'    => $this->upi->data_pdf(),
                   'produk_selected' => '',
                   'upi_selected' => '',
                    
              );
    $this->load->view('v_laporan', $data);
}

function excel()
{
     $data = array('header_judul'  => 'Laporan Excel',
                   'data_produk'    => $this->prod->get_produk(),
                   'data_upi'    => $this->upi->data_pdf(),
                   'produk_selected' => '',
                   'upi_selected' => '',
              );
    $this->load->view('v_laporan', $data);
}
  
function cetak_pdf()
     {

           
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
