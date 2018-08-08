<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Url;
use App\Utilities\FormatErrorMessage;
class UrlsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $url_post = $request->url;
        
        if( empty($request->url) )
        {
            $errors = [
                "http_response_code" => 400,
                "response" =>  "Bad request",
                "comment" => "Invalid URL",
                "bad_url"   => $url_post,
                "message"   => FormatErrorMessage::replaceAttributeToFieldName(\Lang::get('validation.required'), "url", $url_post)
            ];
            return redirect()->back()->withErrors($errors);
        }

        //Validation de l'url
        $validUrl = Url::validUrl( $url_post );
        if( $validUrl )
        {
            // Check si URl deja raccourcie
            $url = Url::whereUrl($url_post)->first();
            // Sinon creation d'une nouvelle short url 
            if( !$url )
            {
                // create new shortened url
                $url = Url::create([
                    "url" => $url_post,
                    "shortened" => Url::generateShortenedURL()
                ]);


                
            }

            return view('pages.result')->withUrlShortened($url->shortened);
        }
        $errors = [
            "http_response_code" => 400,
            "response" =>  "Bad request",
            "comment" => "Invalid URL",
            "bad_url"   => $url_post,
            "message"   => FormatErrorMessage::replaceAttributeToFieldName(\Lang::get('validation.url'), "url", $url_post)
        ];
        return redirect()->back()->withErrors($errors);
        // return short url
        dd($request->url);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $shortURL )
    {

        $url_exist = Url::whereShortened($shortURL)->firstOrFail();
        $url = $url_exist->url;
        if(strstr($url, "http") )
        {
            return Redirect::to($url);
        }
        return Redirect::to("http://".$url);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
