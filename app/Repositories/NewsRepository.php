<?php

namespace App\Repositories;

use App\Http\Requests\NewsRequest;
use \App\Models\News;

class NewsRepository
{
    function store($dataArray)
    {
        News::create($dataArray);
    }

    function ValidateExist($request) : bool
    {
        return (bool)News::title($request['title'])->pathUrl($request['url'])->first();
    }
    function ValidateApiExist($request)
    {
        return (bool)News::title($request['title'])->resource($request['resource_id'])->category($request['category_id'])->first();
    }

}
