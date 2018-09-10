<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Url;
use Carbon\Carbon;
use Facades\App\Helpers\UrlHlp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class UrlController extends Controller
{
    public function create(Requests\StoreUrl $request)
    {
        $long_url = Input::get('long_url');
        $short_url = UrlHlp::url_generator();
        $short_url_custom = Input::get('short_url_custom');

        $shortUrl = $short_url_custom ?? $short_url;

        Url::create([
            'user_id'           => Auth::check() ? Auth::id() : 0,
            'long_url'          => $long_url,
            'long_url_title'    => UrlHlp::get_title($long_url),
            'short_url'         => $short_url,
            'short_url_custom'  => $short_url_custom ?? 0,
            'views'             => 0,
            'ip'                => $request->ip(),
        ]);

        return redirect('/+'.$shortUrl);
    }

    public function view($short_url)
    {
        $url = Url::where('short_url', 'LIKE BINARY', $short_url)
                    ->orWhere('short_url_custom', $short_url)
                    ->firstOrFail();

        if ($url->short_url_custom) {
            $blabla = $url->short_url_custom;
        } else {
            $blabla = $url->short_url;
        }

        $qrCode = qrCodeGenerator($url->short_url);

        return view('frontend.short', [
            'long_url'          => $url->long_url_mod,
            'long_url_href'     => $url->long_url,
            'long_url_title'    => $url->long_url_title,
            'views'             => $url->views,
            'short_url'         => urlToDomain(url('/', $blabla)),
            'short_url_href'    => url('/', $blabla),
            'qrCodeData'        => $qrCode->getContentType(),
            'qrCodebase64'      => $qrCode->generate(),
            'created_at'        => Carbon::parse($url->created_at)->toDayDateTimeString(),
        ]);
    }

    public function delete($id)
    {
        Url::destroy($id);

        return redirect()->back();
    }

    public function urlRedirection($short_url)
    {
        $url = Url::where('short_url', 'LIKE BINARY', $short_url)
                    ->orWhere('short_url_custom', $short_url)
                    ->firstOrFail();

        $url->increment('views');

        // Redirect to final destination
        return redirect()->away($url->long_url, 301);
    }
}
