<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

    public $viewFolder = "";

    public function __construct()
    {
        parent::__construct();
        $this->load->model("ProductModel");
        $this->viewFolder  = "product";
    }

    public function index()
	{
	    $viewData = new stdClass();
	    $viewData->viewFolder = $this->viewFolder;
	    $viewData->subViewFolder = "list";
        $items = $this->ProductModel->get_all();
        $viewData->items = $items;

		$this->load->view("{$this->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
	}

	public function new_form()
    {
        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "add";

        $this->load->view("{$this->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function save()
    {
        $this->load->library("form_validation");

        $this->form_validation->set_rules("title", "Başlık", "required|trim");

        $this->form_validation->set_message(
            array(
                "required" => "<b>{field}</b> Alanı Doldurulmalıdır."
            )
        );

        $validate = $this->form_validation->run();
        if ($validate){
            echo 1;
        } else {
            echo validation_errors();
        }


//        echo "saved";
    }
}
