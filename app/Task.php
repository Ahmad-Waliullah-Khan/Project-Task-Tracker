<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
  public function log()
  {
      return $this->hasOne('App\Log');
  }

  public function project()
  {
      return $this->belongsTo('App\Project');
  }
}
