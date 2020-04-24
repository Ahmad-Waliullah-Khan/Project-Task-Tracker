<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
  public function logged_task()
  {
      return $this->hasOne('App\Task');
  }
}
