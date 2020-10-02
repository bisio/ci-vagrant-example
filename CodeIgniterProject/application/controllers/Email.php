<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
  $this->load->library('email');

  $this->email->from('thaisesr@gmail.com', 'Test');
  $this->email->to('someone@example.com');
  // $this->email->cc('another@another-example.com');
  // $this->email->bcc('them@their-example.com');

  $this->email->subject('Email Test');
  $this->email->message('Testing the email class.');

  $this->email->send();
  }
}
