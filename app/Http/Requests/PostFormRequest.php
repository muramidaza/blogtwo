<?php namespace App\Http\Requests;
use App\User;
use Auth;
use Illuminate\Foundation\Http\FormRequest;

class PostFormRequest extends FormRequest {
  /**
   * Определить авторизирован ли пользователь делать этот запрос.
   *
   * @return bool
   */
  public function authorize()
  {    
    if($this->user()->can_post())
    {
      return true;
    }
    return false;
  }
  /**
   * Получить правила валидации, которые применяются к запросу
   *
   * @return array
   */
  public function rules()
  {
    return [
      'title' => 'required|unique:posts|max:255',
      //'title' => array('Regex:/^[A-Za-z0-9 А-Яа-яЁё]+$/'),
      'body' => 'required',
    ];
  }    
}
