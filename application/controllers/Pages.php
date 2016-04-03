<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->model('news_model');
    $this->load->helper('url_helper');
  }

	public function index()
	{
    echo "Hi there";
	}

	public function view($page = 'home')
	{
    if(! file_exists(APPPATH.'/views/pages/'.$page.'.php'))
    {
      show_404();
    }

    $data['title'] = ucfirst($page);

    $this->load->view('templates/header', $data);
    $this->load->view('pages/'.$page, $data);
    $this->load->view('templates/footer', $data);
	}

  public function news($slug = NULL){
    if(empty($slug))
      $data['news'] = $this->news_model->get_news();
    else
      $data['news'] = $this->news_model->get_news($slug);
    if(empty($data['news'])){
      show_404();
    }

    $data['title'] = 'New news';

    $this->load->view('templates/header', $data);

    if(empty($slug))
      $this->load->view('news/index', $data);
    else
      $this->load->view('news/show', $data);

    $this->load->view('templates/footer', $data);
  }
}
