<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ticket extends CI_Controller {
  function __construct() {
    parent::__construct();
    $this->load->library('unit_test');
    $this->load->model('ticketModel', '', TRUE);
  }

  function index(){
      $data['main_content'] = 'ticketView';      
      $this->load->view('template', $data);       
  }

  function payTicket(){
    if(isset($_POST['sendInfo'])){
      $ticket = $_POST;

      $priceInfo = $this->calcPrice($ticket['dob']);

      $data['ticketInfo'] = $ticket;
      $data['priceInfo'] = $priceInfo;

      $this->load->view('payTicketView', $data);
    }else{
      redirect('ticket');
    }
  }

  function displayTicket(){
    if(!isset($_POST['ticket']) && !isset($_POST['price'])){
      redirect('ticket');
    }
    $ticket = $_POST['ticket'];
    $data['barcodeID'] = $this->getBarcode();
    $data['price'] = $_POST['price'];
    $data['ticket'] = $_POST['ticket'];
    $data['imgDay'] = $this->imgDay();

    $this->ticketModel->addTicket($ticket, $this->getBarcode());

    ini_set('memory_limit','32M'); // boost the memory limit if it's low <img src="https://davidsimpson.me/wp-includes/images/smilies/icon_wink.gif" alt=";)" class="wp-smiley">
    $html = $this->load->view('showTicketView', $data, true); // render the view into HTML
     
    $this->load->library('pdf');
    $pdf = $this->pdf->load();
    //$pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822)); // Add a footer for good measure <img src="https://davidsimpson.me/wp-includes/images/smilies/icon_wink.gif" alt=";)" class="wp-smiley">
    $pdf->WriteHTML($html); // write the HTML into the PDF
    $pdf->Output('ticket.pdf', 'I'); // save to file because we can
  }

  function calcPrice($dob){
  $age = date_diff(date_create($dob), date_create('today'))->y;
  if($age < '12'){
    $ageName = 'kind';
    $price = '0';
  }else if($age < '17'){
    $ageName = 'jongere';
    $price = '2.50';
  }else if($age < '59'){
    $ageName = 'volwassene';
    $price = '4';
  }else if($age >= '60'){
    $ageName = 'oudere';
    $price = '2.50';
  }
  return array($age, $ageName, $price);  
  }

  function ticketSale(){    
    $this->load->view('ticketSaleView'); 
  }

  function getBarcode(){
    $threedigits = 3;
    $random3 = rand(pow(10, $threedigits-1), pow(10, $threedigits)-1);
    $sevendigits = 7;
    $random7 = rand(pow(10, $sevendigits-1), pow(10, $sevendigits)-1);
    $barcodeID =  $random3."-0-".$random7."-0";
    return $barcodeID;
  }

  private function imgDay(){
    //geeft dag terug. 1 t/m 7
    $i = date('N');
    return $i;
  } 
}