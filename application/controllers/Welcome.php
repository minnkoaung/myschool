<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Public_Controller {

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        // load the language file
        $this->lang->load('welcome');
        //$this->load->model('Properties_model');
    }


    /**
	 * Default
     */
	public function index()
	{
        // setup page header data
        $this->set_title(sprintf(lang('welcome title'), $this->settings->site_name));

        $data = $this->includes;
        // get list
        //$properties = $this->Properties_model->get_all(8);
        //var_dump($properties);
        // set content data
        $content_data = array(
            'welcome_message' => $this->settings->welcome_message[$this->session->language]
            //,'properties' =>  $properties,
        );

        // load views
        $data['content'] = $this->load->view('welcome', $content_data, TRUE);
		$this->load->view($this->template, $data);
	}

 

}
