<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * types Language File
 */

// Titles
$lang['types title forgot']                   = "Forgot Password";
$lang['types title login']                    = "Login";
$lang['types title profile']                  = "Profile";
$lang['types title register']                 = "Register";
$lang['types title user_add']                 = "Add User";
$lang['types title user_delete']              = "Confirm Delete User";
$lang['types title user_edit']                = "Edit User";
$lang['types title types_list']                = "Types List";

// Buttons
$lang['types button add_new_type']            = "Add New Types";
$lang['types button register']                = "Create Account";
$lang['types button reset_password']          = "Reset Password";
$lang['types button login_try_again']         = "Try Again";

// Tooltips
$lang['types tooltip add_new_type']           = "Create a brand new type.";

// Links
$lang['types link forgot_password']           = "Forgot your password?";
$lang['types link register_account']          = "Register for an account.";

// Table Columns
$lang['types col parent_id']                 = "Parent ID";
$lang['types col is_admin']                   = "Admin";
$lang['types col updated_at']                  = "Updated At";
$lang['types col updated_by']                  = "Updated By";
$lang['types col user_id']                    = "ID";
$lang['types col name']                   = "Name";

// Form Inputs
$lang['types input parent_id']               = "Parent ID";
$lang['types input updated_at']                = "Updated At";
$lang['types input updated_by']                 = "Updated By";
$lang['types input name']                 = "Name";
$lang['types input username_email']           = "Username or Email";

// Help
$lang['types help passwords']                 = "Only enter passwords if you want to change it.";

// Messages
$lang['types msg add_user_success']           = "%s was successfully added!";
$lang['types msg delete_confirm']             = "Are you sure you want to delete <strong>%s</strong>? This can not be undone.";
$lang['types msg delete_user']                = "You have succesfully deleted <strong>%s</strong>!";
$lang['types msg edit_profile_success']       = "Your profile was successfully modified!";
$lang['types msg edit_user_success']          = "%s was successfully modified!";
$lang['types msg register_success']           = "Thanks for registering, %s! Check your email for a confirmation message. Once
                                                 your account has been verified, you will be able to log in with the credentials
                                                 you provided.";
$lang['types msg password_reset_success']     = "Your password has been reset, %s! Please check your email for your new temporary password.";
$lang['types msg validate_success']           = "Your account has been verified. You may now log in to your account.";
$lang['types msg email_new_account']          = "<p>Thank you for creating an account at %s. Click the link below to validate your
                                                 email address and activate your account.<br /><br /><a href=\"%s\">%s</a></p>";
$lang['types msg email_new_account_title']    = "New Account for %s";
$lang['types msg email_password_reset']       = "<p>Your password at %s has been reset. Click the link below to log in with your
                                                 new password:<br /><br /><strong>%s</strong><br /><br /><a href=\"%s\">%s</a>
                                                 Once logged in, be sure to change your password to something you can
                                                 remember.</p>";
$lang['types msg email_password_reset_title'] = "Password Reset for %s";

// Errors
$lang['types error add_user_failed']          = "%s could not be added!";
$lang['types error delete_user']              = "<strong>%s</strong> could not be deleted!";
$lang['types error edit_profile_failed']      = "Your profile could not be modified!";
$lang['types error edit_user_failed']         = "%s could not be modified!";
$lang['types error email_exists']             = "The email <strong>%s</strong> already exists!";
$lang['types error email_not_exists']         = "That email does not exists!";
$lang['types error invalid_login']            = "Invalid username or password";
$lang['types error password_reset_failed']    = "There was a problem resetting your password. Please try again.";
$lang['types error register_failed']          = "Your account could not be created at this time. Please try again.";
$lang['types error user_id_required']         = "A numeric user ID is required!";
$lang['types error user_not_exist']           = "That user does not exist!";
$lang['types error username_exists']          = "The username <strong>%s</strong> already exists!";
$lang['types error validate_failed']          = "There was a problem validating your account. Please try again.";
$lang['types error too_many_login_attempts']  = "You've made too many attempts to log in too quickly. Please wait %s seconds and try again.";
