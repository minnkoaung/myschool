<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Agents extends Admin_Controller {

    /**
     * @var string
     */
    private $_redirect_url;


    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        // load the language files
        $this->lang->load('users');
        $this->lang->load('agents');

        // load the users model
        $this->load->model('users_model');
        $this->load->model('agents_model');

        // set constants
        define('REFERRER', "referrer");
        define('THIS_URL', base_url('admin/agents'));
        define('DEFAULT_LIMIT', $this->settings->per_page_limit);
        define('DEFAULT_OFFSET', 0);
        define('DEFAULT_SORT', "created_at");
        define('DEFAULT_DIR', "desc");

        // use the url in session (if available) to return to the previous filter/sorted/paginated list
        if ($this->session->userdata(REFERRER))
        {
            $this->_redirect_url = $this->session->userdata(REFERRER);
        }
        else
        {
            $this->_redirect_url = THIS_URL;
        }
    }


    /**
     * Add new user
     */
    function add()
    {
        //user validations
        $this->form_validation->set_rules('username', lang('users input username'), 'required|trim|min_length[5]|max_length[30]|callback__check_username[]');
        $this->form_validation->set_rules('first_name', lang('users input first_name'), 'required|trim|min_length[2]|max_length[32]');
        $this->form_validation->set_rules('last_name', lang('users input last_name'), 'required|trim|min_length[2]|max_length[32]');
        $this->form_validation->set_rules('email', lang('users input email'), 'required|trim|max_length[128]|valid_email|callback__check_email[]');
        $this->form_validation->set_rules('language', lang('users input language'), 'required|trim');
        $this->form_validation->set_rules('status', lang('users input status'), 'required|numeric');
        $this->form_validation->set_rules('password', lang('users input password'), 'required|trim|min_length[5]');
        $this->form_validation->set_rules('password_repeat', lang('users input password_repeat'), 'required|trim|matches[password]');
        // agents validators
         $this->form_validation->set_error_delimiters($this->config->item('error_delimeter_left'), $this->config->item('error_delimeter_right'));
        
        

        if ($this->form_validation->run() == TRUE)
        {
            // save the new agents
            $users_data= array(
                    "username"=>$this->input->post("username"),
                    "first_name"=>$this->input->post("first_name"),
                    "last_name"=>$this->input->post("last_name"),
                    "email"=>$this->input->post("email"),
                    "language"=>$this->input->post("language"),
                    "status"=> 0,
                    "is_admin"=> 0,
                    "password"=>$this->input->post("password"),
                    

            );
            // save the new user
            $saved_user = $this->users_model->add_user($users_data);

            if($saved_user){
                $agents_data= array(
                    "company"=>$this->input->post("company"),
                    "company"=>$this->input->post("company"),
                    "company_address"=>$this->input->post("company_address"),
                    "description"=>$this->input->post("description"),
                    "profile_photo"=>$this->input->post("profile_photo"),
                    "contact_phone"=>$this->input->post("contact_phone"),
                    "contact_email"=>$this->input->post("contact_email"),
                    "user_id"=>$saved_user,
                    "verified"=>1,

                    );
                $saved = $this->agents_model->create($agents_data);

                 if ($saved)
            {
                $this->session->set_flashdata('message', sprintf(lang('users msg add_user_success'), $this->input->post('first_name') . " " . $this->input->post('last_name')));
            }
            else
            {
                $this->session->set_flashdata('error', sprintf(lang('users error add_user_failed'), $this->input->post('first_name') . " " . $this->input->post('last_name')));
            }

            }
            
           

            // return to list and display message
            redirect($this->_redirect_url);
        }

        // setup page header data
        $this->set_title( lang('agents title user_add') );

        $data = $this->includes;

        // set content data
        $content_data = array(
            'cancel_url'        => $this->_redirect_url,
            'user'              => NULL,
            'password_required' => TRUE
        );

        // load views
         $content_data['types'] =array("1"=>"Condo",
                              "2"=>"Apartment",
                              "3"=>"Hostel",
                              );
         $content_data['township'] =array("1"=>"Sulay",
                              "2"=>"Mayangone",
                              "3"=>"Haldan",
                              );
         $content_data['region'] =array("1"=>"bahan",
                              "2"=>"kamaryut",
                              "3"=>"sanchaung",
                              );
        $data['content'] = $this->load->view('admin/agents/form', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }



    /**
     * Make sure username is available
     *
     * @param  string $username
     * @param  string|null $current
     * @return int|boolean
     */
    function _check_username($username, $current)
    {
        if (trim($username) != trim($current) && $this->users_model->username_exists($username))
        {
            $this->form_validation->set_message('_check_username', sprintf(lang('users error username_exists'), $username));
            return FALSE;
        }
        else
        {
            return $username;
        }
    }


     /**
     * Make sure email is available
     *
     * @param  string $email
     * @param  string|null $current
     * @return int|boolean
     */
    function _check_email($email, $current)
    {
        if (trim($email) != trim($current) && $this->users_model->email_exists($email))
        {
            $this->form_validation->set_message('_check_email', sprintf(lang('users error email_exists'), $email));
            return FALSE;
        }
        else
        {
            return $email;
        }
    }


    /**************************************************************************************
     * PUBLIC FUNCTIONS
     **************************************************************************************/


    /**
     * User list page
     */
    function index()
    {
        // get parameters
        $limit  = $this->input->get('limit')  ? $this->input->get('limit', TRUE)  : DEFAULT_LIMIT;
        $offset = $this->input->get('offset') ? $this->input->get('offset', TRUE) : DEFAULT_OFFSET;
        $sort   = $this->input->get('sort')   ? $this->input->get('sort', TRUE)   : DEFAULT_SORT;
        $dir    = $this->input->get('dir')    ? $this->input->get('dir', TRUE)    : DEFAULT_DIR;

        // get filters
        $filters = array();

        if ($this->input->get('username'))
        {
            $filters['username'] = $this->input->get('username', TRUE);
        }

        if ($this->input->get('first_name'))
        {
            $filters['first_name'] = $this->input->get('first_name', TRUE);
        }

        if ($this->input->get('last_name'))
        {
            $filters['last_name'] = $this->input->get('last_name', TRUE);
        }

        // build filter string
        $filter = "";
        foreach ($filters as $key => $value)
        {
            $filter .= "&{$key}={$value}";
        }

        // save the current url to session for returning
        $this->session->set_userdata(REFERRER, THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");

        // are filters being submitted?
        if ($this->input->post())
        {
            if ($this->input->post('clear'))
            {
                // reset button clicked
                redirect(THIS_URL);
            }
            else
            {
                // apply the filter(s)
                $filter = "";

                if ($this->input->post('username'))
                {
                    $filter .= "&username=" . $this->input->post('username', TRUE);
                }

                if ($this->input->post('first_name'))
                {
                    $filter .= "&first_name=" . $this->input->post('first_name', TRUE);
                }

                if ($this->input->post('last_name'))
                {
                    $filter .= "&last_name=" . $this->input->post('last_name', TRUE);
                }

                // redirect using new filter(s)
                redirect(THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
            }
        }

        // get list
        $users = $this->agents_model->get_all($limit, $offset, $filters, $sort, $dir);

        // build pagination
        $this->pagination->initialize(array(
            'base_url'   => THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}{$filter}",
            'total_rows' => $users['total'],
            'per_page'   => $limit
        ));

        // setup page header data
        $this
            ->add_js_theme( "users_i18n.js", TRUE )
            ->set_title( lang('agents title user_list') );

        $data = $this->includes;

        // set content data
        $content_data = array(
            'this_url'   => THIS_URL,
            'users'      => $users['results'],
            'total'      => $users['total'],
            'filters'    => $filters,
            'filter'     => $filter,
            'pagination' => $this->pagination->create_links(),
            'limit'      => $limit,
            'offset'     => $offset,
            'sort'       => $sort,
            'dir'        => $dir
        );

        // load views
        $data['content'] = $this->load->view('admin/agents/list', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }






    


    

}
