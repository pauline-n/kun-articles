<?php

namespace App\Http\Controllers;

use App\Http\Resources\Article as ArticleResource;
use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::paginate(15);

        //return the collection of articles as a resource
        return ArticleResource::collection($articles);
    }

    /**
     * Show the form for creating a new resource.
     *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //if the article being stored is of method put or patch then find its id and update else create new article
        // $article = $request->isMethod('put') ? Article::findOrFail($request->article_id): new Article;

        //lets only do posts here for creating a new article
        $article = new Article;

        //provide the input for the fields, id will be auto generated
        $article->title = $request->input('title');
        $article->body = $request->input('body');
        //if the article is created save it and create a new article for the article rresource
        if($article->save()){
            return new ArticleResource($article);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //for getting an individual article
        $article = Article::findOrFail($id);

        //return a single article as a resouce
        return new ArticleResource($article); //and as u test in postman it returns it in a data wrapping but u can change this via the appservcie providers
    }

    /**
     * Show the form for editing the specified resource.
     *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id); //first find the article by its id
        //edit the article's fields that si title, body
        // $article->title=$request->input('title');
        // $article->body=$request->input('body');

        //for a patch
        $validateArticle = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'body' => 'sometimes|required|string',
        ]);

        if($request->has('title')){
            $article->title = $validateArticle['title'];

        }
        if($request->has('body')){
            $article->body = $validateArticle['body'];
        }
        //save to db
        if($article->save()){
            return new ArticleResource($article);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        if($article->delete()){
            return new ArticleResource($article);
        }

    }
}
