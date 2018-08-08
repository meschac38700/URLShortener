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
            //si pas de resultat creation d'un shortened et stockage dans la BD
            $url = Url::firstOrCreate(
                            ['url'=>$url_post], // conditions de la requete
                            ['shortened'=>Url::generateShortenedURL()] // data necessaire à la création si l'url n'existe pas
                        );

            return view('pages.result')->withUrlShortened($url->shortened);
        }
        // Si url pas valide 
        $errors = [
            "http_response_code" => 400,
            "response" =>  "Bad request",
            "comment" => "Invalid URL",
            "bad_url"   => $url_post,
            "message"   => FormatErrorMessage::replaceAttributeToFieldName(\Lang::get('validation.url'), "url", $url_post)
        ];
        // redirection vers la page d'accueil avec un message d'erreur
        return redirect()->back()->withErrors($errors);
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
