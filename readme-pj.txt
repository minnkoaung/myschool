CI Controller

Backend Controller			Frontend Controller
setting controller			public controller - > not login ------------- private controoler -> mean profile controller
user manage controller		

routing-> controller/action name
	welcome/something

language 
php to javascript variable
theme 
app->core->MY_Controller->set_template (-4) ေနာက္က extention ကိုသိခ်င္းလို့

core-> my_con line 36(site_version)  --> config->core version
core-> admin-controller -> config ကိုလွမ္ယူထား

theme တခုကို create လုပ္ခ်င္းရင္ htdocs ေအာက္က theme 

sample theme ကို ေဆာက္ျပီးပါက 
core-> public_controller.php မွာျပင္ , congig-> core.php မွာျပင္


DB Design -> real estate (main content -> property -> 1) type ေတြရွိတယ္) 
ေျမကြက္, ကြန္ဒို, စက္မူစုန္, တိုက္ခန္း ...etc.
2) location - > ရွိိတယ္
3) - agents (mean - people,company field )
4) - users
5) - articles


themeကို ေဆာက္ခ်င္းပါက htdocs-> theme>my theme ျပီးရင္ config-> core.php

name  က ရန္ကုန္
type   က မရမ္းကုန္း
name - mayangone
type  - township


status -> owner က review လုပ္ေပး 
area -> 
property id
meta key -> mean field name (eg aircon,etc.)
meta value -> yes or no

properties အတြက္ model ေဆာက္
type
property_metas
location
agent
