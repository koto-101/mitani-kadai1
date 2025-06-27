<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\AdminRequest;
use Illuminate\Support\Facades\Response;

class AdminController extends Controller
{
    public function index(AdminRequest $request)
    {
        $query = Contact::query();

        $target = $request->input('target', 'name'); 
        $keyword = '';

        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword'); // キーワードの取得
            if (!empty($keyword)) {
                if ($target === 'name') {
                    // 名前検索（完全一致 + 部分一致）
                    $query->where(function ($q) use ($keyword) {
                        // 完全一致検索
                        $q->whereRaw("CONCAT(last_name, first_name) LIKE ?", ["%$keyword%"])
                        ->orWhere('last_name', 'LIKE', "%$keyword%")
                        ->orWhere('first_name', 'LIKE', "%$keyword%");
                    });
                } elseif ($target === 'email') {
                    // メールアドレス検索（完全一致 + 部分一致）
                    $query->where(function ($q) use ($keyword) {
                        $q->where('email', 'LIKE', "%$keyword%");
                    });
                }
            }
        }
    

         // 性別
        if ($request->filled('gender')) {
            $query->where('gender', $request->input('gender'));
        }

        // カテゴリー
        if ($request->filled('category_id')) {
            $category_id = $request->input('category_id');
            $query->where('category_id', $category_id);
        }

        // 日付
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->input('date'));
        }

        // 結果を取得
        $contacts = $query->paginate(7);

        return view('admin', compact('contacts'));
    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return view('admin_detail', compact('contact'));
    }

    public function export(AdminRequest $request)
    {
        $query = Contact::query();

        // 同じフィルタリングロジック
        if ($request->filled('name')) {
            $name = $request->input('name');
            $match = $request->input('name_match', 'partial');

            $query->where(function ($q) use ($name, $match) {
                if ($match === 'exact') {
                    $q->whereRaw("CONCAT(last_name, first_name) = ?", [$name])
                      ->orWhere('last_name', $name)
                      ->orWhere('first_name', $name);
                } else {
                    $q->whereRaw("CONCAT(last_name, first_name) LIKE ?", ["%$name%"])
                      ->orWhere('last_name', 'LIKE', "%$name%")
                      ->orWhere('first_name', 'LIKE', "%$name%");
                }
            });
        }

        if ($request->filled('email')) {
            $match = $request->input('email_match', 'partial');
            $email = $request->input('email');

            $query->where('email', $match === 'exact' ? '=' : 'LIKE', $match === 'exact' ? $email : "%$email%");
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->input('gender'));
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->input('date'));
        }

        $contacts = $query->get();

        $csvData = [];
        $csvData[] = ['氏名', 'メールアドレス', '性別', 'お問い合わせ種類', '日付'];

        foreach ($contacts as $contact) {
            $csvData[] = [
                $contact->last_name . ' ' . $contact->first_name,
                $contact->email,
                ['未設定','男性','女性','その他'][$contact->gender] ?? '未設定',
                $contact->category_id,
                $contact->created_at->format('Y-m-d'),
            ];
        }

        $filename = 'contacts_export_' . now()->format('Ymd_His') . '.csv';

        $handle = fopen('php://temp', 'r+');
        foreach ($csvData as $row) {
            fputcsv($handle, $row);
        }
        rewind($handle);
        $content = stream_get_contents($handle);
        fclose($handle);

        return response($content)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', "attachment; filename={$filename}");
    }

    public function destroy($id)
{
    $contact = Contact::findOrFail($id);
    $contact->delete();

    return redirect('/admin')->with('success', '削除しました');
}
}
