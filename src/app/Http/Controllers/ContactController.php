<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;

class ContactController extends Controller
{
  public function index(Request $request)
  {
    $inputs = $request->old();
    return view('contact', compact('inputs'));
  } 

  public function confirm(ContactRequest $request)
  {
    $inputs = $request->validated();

    // 送信されたgenderが"男性"などの文字列なら、数字に変換する
    $genderMap = ['男性' => 1, '女性' => 2, 'その他' => 3];

    if (isset($genderMap[$inputs['gender']])) {
        $inputs['gender'] = $genderMap[$inputs['gender']];
    }

    return view('confirm', compact('inputs'));
  }

  public function send(Request $request)
  {

    $request->merge([
    'detail' => $request->input('message'),
    ]);
    // hiddenから再取得
    Contact::create($request->only([
    'last_name', 'first_name', 'gender', 'email',
    'tel', 'address', 'building', 'category_id', 'detail'
    ]));

    return view('thanks');
  }
}
