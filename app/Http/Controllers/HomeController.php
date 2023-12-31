<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Gloudemans\Shoppingcart\Facades\Cart;
use Socialite;
use App\Models\ChuDe;
use App\Models\BaiViet;
use App\Models\User;
class HomeController extends Controller
{

    public function getBaiViet($tenchude_slug = '')
    {
        if(empty($tenchude_slug))
        {
            $title = 'Tin tức';
            $baiviet = BaiViet::where('kichhoat', 1)
            ->where('kiemduyet', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        }
        else
        {
            $chude = ChuDe::where('tenchude_slug', $tenchude_slug)
            ->firstOrFail();
            $title = $chude->tenchude;
            $baiviet = BaiViet::where('kichhoat', 1)
            ->where('kiemduyet', 1)
            ->where('chude_id', $chude->id)
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        }

        return view('frontend.baiviet', compact('title', 'baiviet'));
    }

    public function getBaiViet_ChiTiet($tenchude_slug = '', $tieude_slug = '')
    {
        $tieude_id = explode('.', $tieude_slug);
        $tieude = explode('-', $tieude_id[0]);
        $baiviet_id = $tieude[count($tieude) - 1];

        $baiviet = BaiViet::where('kichhoat', 1)
        ->where('kiemduyet', 1)
        ->where('id', $baiviet_id)
        ->firstOrFail();

        if(!$baiviet) abort(404);

        // Cập nhật lượt xem
        $daxem = 'BV' . $baiviet_id;
        if(!session()->has($daxem))
        {
            $orm = BaiViet::find($baiviet_id);
            $orm->luotxem = $baiviet->luotxem + 1;
            $orm->save();
            session()->put($daxem, 1);
        }

        $baivietcungchuyemuc = BaiViet::where('kichhoat', 1)
        ->where('kiemduyet', 1)
        ->where('chude_id', $baiviet->chude_id)
        ->where('id', '!=', $baiviet_id)
        ->orderBy('created_at', 'desc')
        ->take(4)->get();

        return view('frontend.baiviet_chitiet', compact('baiviet', 'baivietcungchuyemuc'));
    }

}
