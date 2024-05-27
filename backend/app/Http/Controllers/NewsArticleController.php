<?php

namespace App\Http\Controllers;


use App\Actions\NewsArticle\PaginateListNewsArticleAction;
use App\Http\Requests\NewsArticle\GetNewsArticleRequest;
use App\Http\Requests\NewsArticle\ListNewsArticleRequest;
use App\Http\Resources\NewsArticle\NewsArticleResource;
use App\Libs\Response\Error;
use App\Libs\Response\Success;
use App\Repositories\NewsArticleRepository;

class NewsArticleController extends Controller
{

    public function get(
        GetNewsArticleRequest $request,
        NewsArticleRepository $newsArticleRepository
    ): Success|Error
    {
        $article = $request->has('id')
            ? $newsArticleRepository->findById($request->input('id'))
            : $newsArticleRepository->findByLink($request->input('link'));

        if ($article === null) {
            return new Error('Новости не существует');
        }

        return new Success(new NewsArticleResource($article));
    }

    public function list(
        ListNewsArticleRequest $request,
        PaginateListNewsArticleAction $paginateListNewsArticleAction,
    ): Success|Error
    {
        return new Success(
            $paginateListNewsArticleAction->execute(
                $request->input('category_id') ?? null,
                $request->input('page') ?? 1,
                $request->input('limit') ?? null,
            )
        );
    }

}
