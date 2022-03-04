<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;
use Lorisleiva\Actions\Concerns\AsAction;
use Lorisleiva\Actions\ActionRequest;

class UpdatedUserPassword
{
  use AsAction;

  /**
   * @var User
   */
  private $users;

  public function rules()
  {
   /*return [
      'name' => ['required'],
    ];*/
  }
  /*
  public function withValidator(Validator $validator, ActionRequest $actionRequest)
  {
    $validator->after(function ($validator) use ($actionRequest) {
      $validator->errors()->add('name', 'The user firstname is required');
      //dd($actionRequest);
    });

  }*/

  public function handle(string $name)
  {

    //dd($this->users->findOrFail(1));
    $user = User::findOrFail(1);
    $user->first_name = $name;
    $user->save();
    dd($user);
  }

  public function asController(ActionRequest $actionRequest)
  {
    if (!empty($actionRequest->validated()['name'])) {
      return $this->handle($actionRequest->get('name'));
    }
  }

}
