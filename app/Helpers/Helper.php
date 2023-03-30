<?php

use App\Models\PageMetaTag;
use App\Models\CustomBox;
use App\Models\Accordian;
use Illuminate\Support\Facades\DB;

// single image upload
if (!function_exists('single_image_upload')) {
  function single_image_upload($image, $path)
  {
    $destination = storage_path() . '/app/public/' . $path;
    $Image_New_Name = (str_replace(" ", "", microtime())) . '-' . $image->getClientOriginalname();
    if ($image->move($destination, $Image_New_Name)) {
      return $path . '/' . $Image_New_Name;
    } else {
      return 0;
    }
  }
}

//get meta tag value
if (!function_exists('Get_Meta_Tag_Value')) {
  function Get_Meta_Tag_Value($type, $key)
  {
    $tag = PageMetaTag::where('type', '=', $type)->where('key', '=', $key)->first();
    if ($tag) {
      return ($tag->value);
    } else {
      return ("");
    }
  }
}

//get custom boxes
if (!function_exists('Get_Custom_Boxes')) {
  function Get_Custom_Boxes($slug)
  {
    return CustomBox::where('type', $slug)->where('status', 1)->get();
  }
}

//get accordians
if (!function_exists('Get_Accordians')) {
  function Get_Accordians($slug)
  {
    return Accordian::where(['page_title' => $slug, 'status' => 1])->get();
  }
}

//====================================================================overriding paypal config settings start=================================================
function updatePaypalConfigVariable()
{
  return [
    'paypal.mode' => Get_Meta_Tag_Value('Payment_Settings', 'paypal_mode'),
    'paypal.sandbox.client_id' => Get_Meta_Tag_Value('Payment_Settings', 'paypal_client_id'),
    'paypal.sandbox.client_secret' => Get_Meta_Tag_Value('Payment_Settings', 'paypal_client_secret'),
    'paypal.sandbox.app_id' => Get_Meta_Tag_Value('Payment_Settings', 'paypal_app_id'),
    'paypal.live.client_id' => Get_Meta_Tag_Value('Payment_Settings', 'paypal_client_id'),
    'paypal.live.client_secret' => Get_Meta_Tag_Value('Payment_Settings', 'paypal_client_secret'),
    'paypal.live.app_id' => Get_Meta_Tag_Value('Payment_Settings', 'paypal_app_id'),
    'paypal.payment_action' => 'Sale',
    'paypal.currency' => Get_Meta_Tag_Value('Payment_Settings', 'paypal_currency'),
    'paypal.billing_type' => 'MerchantInitiatedBilling',
    'paypal.notify_url' => '',
    'paypal.locale' => '',
    'paypal.validate_ssl' => true,
  ];
}

//====================================================================overriding paypal config settings complete=================================================

//get default values from master table 
function get_default_values_from_mastertable($table_name, $column_name)
{
  if ($table_name == "" || $column_name == "")
    return 0;
  else {
    $default_values = DB::table('mastertable_for_defaultvalues')->where([['table_name', $table_name], ['column_name', $column_name]])->first();
    if ( $default_values) {
      $default_values_array =  (json_decode($default_values->keys_values, true));
      return $default_values_array;
    }
    return 0;
  }
}
