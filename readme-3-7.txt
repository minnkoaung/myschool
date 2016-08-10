1. Model --> Properties Model
contact model -> from contact form
setting model -> site -> setting
contact model ကိုကူျပီး proerties model ထဲကိုထည့္ ျပီးေတာ့ class name ကိုေျပာင္, $this->_db = 'properties';  (db name chagne)
(line 215) public function read($id = NULL, $read_by = NULL) ေနရာမွာ return false အထိ ျဖတ္

save_and_send_message (database ပို့ message send)
sql ကေန ; အထိျဖတ္
line 117 (try, cache ကိုျဖတ္)

$this->db mean ---> database libraries


2- Controller
create Properties 
copy user paste proper
line (22 change model name  $this->load->model('Properties_model');
)
define('THIS_URL', base_url('admin/properties'));
define('DEFAULT_SORT', "created_at");
define('DEFAULT_DIR', "asc");

if ($this->session->userdata(REFERRER)) ---> လက္ရွိဝင္ထားတဲ့ user ရဲ့ information ကိုလိုခ်င္းလို့
line 53) function index() (public ထပ္ထည့္)

edit
delete
views-> admin-> copy users folder->rename (properties)
list.php
language en ေပၚခ်င္းပါက users_lang file ကို copy ျပီးေတာ့ properties_lang.php ေဆာက္လိုက္တယ္။
users ကို properties လို့ေျပာင္း
Property List ကိုေပၚခ်င္းလိုပါက list.php မွာ user_list ကို properties_list

pro-land မွာ add_new_user ကို add_new_property ေျပာင္ျပီးရင္ list.php မွာ ေျပာင္း
tooltip mean over mouse လုပ္တဲ့အခ်ိန္မွာ ေပၚတဲ့
create new user btn ko click လိုက္ရင္ list.php မွာ line 10 users change properties
create file

properties controller chagne line 19
open properties_lang = chagne User list to property list
admin/properties/add

add new record btn ko click yin title မေပၚဘူး
အဲဒါကိုေပၚခ်င္းရင္ views->admin/properties/form မွာ lang(users ကိုေျပာင္း ျပီးရင္ con->properties.php မွာ line 230 users/properties

prp-land မွာ username -> title
form.php မွာ language ko type ေျပာင္ျပီး pro con မွာ  $data['types'] =array("1"=>"Condo",
                              "2"=>"Apartment",
                              "3"=>"Hostel",
                              );
list.php မွာ name ကိုေပၚခ်င္းပါက type_land.php မွာ username ျဖစ္တဲ့ေနရာကို name လို့ေျပာင္