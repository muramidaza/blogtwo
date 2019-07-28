<?php namespace App\Http\Requests;
use App\User;
use Auth;
use Illuminate\Foundation\Http\FormRequest;

class ContragentFormRequest extends FormRequest {
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
			'name' => 'required|unique:contragents|max:255',
			'numberdogovor' => 'required',
			'address' => 'required',
			'contactface1' => 'required',
			'contact1' => 'required',
		];
	}

	public function messages()
	{
		return [
			'name.required' => 'Необходимо указать название',
			'numberdogovor.required'	=> 'Необходимо указать номер договора',
			'address.required'	=> 'Необходимо указать адрес',
			'contactface1.required'	=> 'Необходимо ФИО контактного лица',
			'contact1.required'	=> 'Необходимо указать контактный телефон',
		];
	}

}
