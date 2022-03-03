<?php

namespace App\Actions;

use App\Models\User;
use Lorisleiva\Actions\Concerns\AsAction;


class SearchUser
{
  use AsAction;

  public function handle($users){
    $query = 'bell'; // <-- Change the query for testing.
    return $users::search($query)->get();
    //dd(User::search($query)->get());
  }

  public function asController(User $users)
  {
    return $this->handle($users);
  }

  public function htmlResponse($users)
  {
    return view('userSearch', $users);

  }

}
