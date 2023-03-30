<?php

namespace App\Http\Traits;
use App\Models\Admin\EmailTemplate;

trait EmailTrait {
    public function FindTemplate($slug) {
      $email = EmailTemplate::where('slug',$slug)->first();
      return $email;
    }
    
}