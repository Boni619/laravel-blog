<?php

use App\User;

if (!function_exists('str_limit')) {
  function str_limit($value, $limit = 100, $end = '...')
  {
    $limit = $limit - mb_strlen($end); // Take into account $end string into the limit
    $valuelen = mb_strlen($value);
    return $limit < $valuelen ? mb_substr($value, 0, mb_strrpos($value, ' ', $limit - $valuelen)) . $end : $value;
  }
}

if (!function_exists('getUserName')) {
  function getUserName($id)
  {
    $user = User::where('id', $id)->where('status', STATUS_ACTIVE)->select('name')->first();

    if (!empty($user)) {
      return $user->name;
    } else {
      return '';
    }
  }
}
