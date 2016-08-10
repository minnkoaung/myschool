<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Property extends Public_Controller {

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        // load the language file
        $this->lang->load('welcome');
        $this->load->model('Properties_model');
    }


    /**
	 * Default
     */
	public function index($id)
	{
        $this->set_title(sprintf(lang('welcome title'), $this->settings->site_name));

        $data = $this->includes;
        // get list
        $property = $this->Properties_model->get($id);

        $content_data = array(
            'welcome_message' => $this->settings->welcome_message[$this->session->language]
            ,'property' =>  $property,
        );

        // load views
        $data['content'] = $this->load->view('property', $content_data, TRUE);
        $this->load->view($this->template, $data);
	}
	public function details($id)
	{
        $this->set_title(sprintf(lang('welcome title'), $this->settings->site_name));

        $data = $this->includes;
        // get list
        $property = $this->Properties_model->get($id);

        $content_data = array(
            'welcome_message' => $this->settings->welcome_message[$this->session->language]
            ,'property' =>  $property,
        );

        // load views
        $data['content'] = $this->load->view('property', $content_data, TRUE);
        $this->load->view($this->template, $data);
	}


}
