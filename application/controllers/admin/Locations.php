<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Locations extends Admin_Controller {

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
        $this->lang->load('locations');

        // load the users model
        $this->load->model('locations_model');

        // set constants
        define('REFERRER', "referrer");
        define('THIS_URL', base_url('admin/locations'));
        define('DEFAULT_LIMIT', $this->settings->per_page_limit);
        define('DEFAULT_OFFSET', 0);
        define('DEFAULT_SORT', "updated_at");
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

        if ($this->input->get('name'))
        {
            $filters['name'] = $this->input->get('name', TRUE);
        }

        if ($this->input->get('parent_id'))
        {
            $filters['parent_id'] = $this->input->get('parent_id', TRUE);
        }

        if ($this->input->get('updated_by'))
        {
            $filters['updated_by'] = $this->input->get('updated_by', TRUE);
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

                if ($this->input->post('name'))
                {
                    $filter .= "&name=" . $this->input->post('name', TRUE);
                }

                if ($this->input->post('parent_id'))
                {
                    $filter .= "&parent_id=" . $this->input->post('parent_id', TRUE);
                }

                if ($this->input->post('updated_by'))
                {
                    $filter .= "&updated_by=" . $this->input->post('updated_by', TRUE);
                }

                // redirect using new filter(s)
                redirect(THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
            }
        }

        // get list
        $locations = $this->locations_model->get_all($limit, $offset, $filters, $sort, $dir);

        // build pagination
        $this->pagination->initialize(array(
            'base_url'   => THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}{$filter}",
            'total_rows' => $locations['total'],
            'per_page'   => $limit
        ));

        // setup page header data
		$this
			->add_js_theme( "users_i18n.js", TRUE )
			->set_title( lang('users title user_list') );

        $data = $this->includes;

        // set content data
        $content_data = array(
            'this_url'   => THIS_URL,
            'locations'  => $locations['results'],
            'total'      => $locations['total'],
            'filters'    => $filters,
            'filter'     => $filter,
            'pagination' => $this->pagination->create_links(),
            'limit'      => $limit,
            'offset'     => $offset,
            'sort'       => $sort,
            'dir'        => $dir
        );

        // load views
        $data['content'] = $this->load->view('admin/locations/list', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }


    /**
     * Add new user
     */
    function add()
    {
        // validators
        // $this->form_validation->set_error_delimiters($this->config->item('error_delimeter_left'), $this->config->item('error_delimeter_right'));
        // $this->form_validation->set_rules('name', lang('types input name'), 'required');
        // $this->form_validation->set_rules('parent_id', lang('types input parent_id'), 'required|numeric');
        // $this->form_validation->set_rules('updated_by', lang('types input updated_by'), 'required|numeric');
        if ($this->form_validation->run() == TRUE)
        {
            // save the new types
            
            // save the new properties
            $locations_data= array(
                    "name"=>$this->input->post("name"),
                    "type"=>$this->input->post("Condo"),
                    "parent_id"=>$this->input->post("parent_id"),
                    "updated_by"=>$this->input->post("updated_by"),
            );
            $saved = $this->locations_model->create($locations_data);

            if ($saved)
            {
                $this->session->set_flashdata('message', sprintf(lang('users msg add_user_success'), $this->input->post('parent_id') . " " . $this->input->post('updated_at')));
            }
            else
            {
                $this->session->set_flashdata('error', sprintf(lang('users error add_user_failed'), $this->input->post('parent_id') . " " . $this->input->post('updated_at')));
            }

            // return to list and display message
            redirect($this->_redirect_url);
        }

        // setup page header data
        $this->set_title( lang('users title user_add') );

        $data = $this->includes;

        // set content data
        $content_data = array(
            'cancel_url'        => $this->_redirect_url,
            'user'              => NULL,
            'password_required' => TRUE
        );

        // load views
        $data['content'] = $this->load->view('admin/locations/form', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }


    /**
     * Edit existing user
     *
     * @param  int $id
     */
    function edit($id = NULL)
    {
        // make sure we have a numeric id
        if (is_null($id) OR ! is_numeric($id))
        {
            redirect($this->_redirect_url);
        }

        // get the data
        $type = $this->locations_model->get($id);

        // if empty results, return to list
        if ( ! $type)
        {
            redirect($this->_redirect_url);
        }

        // validators
        // $this->form_validation->set_error_delimiters($this->config->item('error_delimeter_left'), $this->config->item('error_delimeter_right'));
        // $this->form_validation->set_rules('username', lang('users input username'), 'required|trim|min_length[5]|max_length[30]|callback__check_username[' . $user['username'] . ']');
        // $this->form_validation->set_rules('parent_id', lang('users input parent_id'), 'required|trim|min_length[2]|max_length[32]');
        // $this->form_validation->set_rules('last_name', lang('users input last_name'), 'required|trim|min_length[2]|max_length[32]');
        // $this->form_validation->set_rules('email', lang('users input email'), 'required|trim|max_length[128]|valid_email|callback__check_email[' . $user['email'] . ']');
        // $this->form_validation->set_rules('language', lang('users input language'), 'required|trim');
        // $this->form_validation->set_rules('status', lang('users input status'), 'required|numeric');
        // $this->form_validation->set_rules('is_admin', lang('users input is_admin'), 'required|numeric');
        // $this->form_validation->set_rules('password', lang('users input password'), 'min_length[5]|matches[password_repeat]');
        // $this->form_validation->set_rules('password_repeat', lang('users input password_repeat'), 'matches[password]');

        if (TRUE)
        {
            // save the changes
            $locations_data= array(
                    "name"=>"Tamwe",
                    "type"=>"Apartment",
                    "parent_id"=>4,
                    "updated_by"=>4,

            );
            $saved = $this->locations_model->update($locations_data,5);

            if ($saved)
            {
                $this->session->set_flashdata('message', sprintf(lang('users msg edit_user_success'), $this->input->post('parent_id') . " " . $this->input->post('last_name')));
            }
            else
            {
                $this->session->set_flashdata('error', sprintf(lang('users error edit_user_failed'), $this->input->post('parent_id') . " " . $this->input->post('last_name')));
            }

            // return to list and display message
            redirect($this->_redirect_url);
        }

        // setup page header data
        $this->set_title( lang('users title user_edit') );

        $data = $this->includes;

        // set content data
        $content_data = array(
            'cancel_url'        => $this->_redirect_url,
            'user'              => $user,
            'user_id'           => $id,
            'password_required' => FALSE
        );

        // load views
        $data['content'] = $this->load->view('admin/users/form', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }


    /**
     * Delete a user
     *
     * @param  int $id
     */
    function delete($id = NULL)
    {
        // make sure we have a numeric id
        if ( ! is_null($id) OR ! is_numeric($id))
        {
            // get user details
            $type = $this->locations_model->get($id);

            if ($type)
            {
                // soft-delete the user
                $delete = $this->locations_model->delete($id);

                if ($delete)
                {
                    $this->session->set_flashdata('message', sprintf(lang('users msg delete_user'), $user['parent_id'] . " " . $user['last_name']));
                }
                else
                {
                    $this->session->set_flashdata('error', sprintf(lang('users error delete_user'), $user['parent_id'] . " " . $user['last_name']));
                }
            }
            else
            {
                $this->session->set_flashdata('error', lang('users error user_not_exist'));
            }
        }
        else
        {
            $this->session->set_flashdata('error', lang('users error user_id_required'));
        }

        // return to list and display message
        redirect($this->_redirect_url);
    }


    /**
     * Export list to CSV
     */
    function export()
    {
        // get parameters
        $sort = $this->input->get('sort') ? $this->input->get('sort', TRUE) : DEFAULT_SORT;
        $dir  = $this->input->get('dir')  ? $this->input->get('dir', TRUE)  : DEFAULT_DIR;

        // get filters
        $filters = array();

        if ($this->input->get('username'))
        {
            $filters['username'] = $this->input->get('username', TRUE);
        }

        if ($this->input->get('parent_id'))
        {
            $filters['parent_id'] = $this->input->get('parent_id', TRUE);
        }

        if ($this->input->get('last_name'))
        {
            $filters['last_name'] = $this->input->get('last_name', TRUE);
        }

        // get all users
        $users = $this->users_model->get_all(0, 0, $filters, $sort, $dir);

        if ($users['total'] > 0)
        {
            // manipulate the output array
            foreach ($users['results'] as $key=>$user)
            {
                unset($users['results'][$key]['password']);
                unset($users['results'][$key]['deleted']);

                if ($user['status'] == 0)
                {
                    $users['results'][$key]['status'] = lang('admin input inactive');
                }
                else
                {
                    $users['results'][$key]['status'] = lang('admin input active');
                }
            }

            // export the file
            array_to_csv($users['results'], "users");
        }
        else
        {
            // nothing to export
            $this->session->set_flashdata('error', lang('core error no_results'));
            redirect($this->_redirect_url);
        }

        exit;
    }


    /**************************************************************************************
     * PRIVATE VALIDATION CALLBACK FUNCTIONS
     **************************************************************************************/


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

}
