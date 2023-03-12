<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelper;
use App\Http\Requests\Bot\BotCreateRequest;
use App\Http\Requests\Bot\BotGetRequest;
use App\Http\Requests\Bot\BotUpdateRequest;
use App\Models\Models\Bot;

class BotController extends Controller
{
    public function ping()
    {
        return ApiHelper::successStr('OK');
    }

    public function create(BotCreateRequest $request)
    {
        try {
            $bot = new Bot();
            $bot->bot_id = $request->bot_id;
            $bot->public_key = $request->public_key;
            $bot->private_key = $request->private_key;
            $bot->version = 1;
            $bot->percent = 5;
            $bot->api_key = '';
            $bot->category_id = 0;
            if ($bot->save())
                return ApiHelper::success($bot->toArray());
            return ApiHelper::error('bot not create');
        } catch (\Exception $e) {
            return ApiHelper::error($e->getMessage());
        }
    }

    public function get(BotGetRequest $request)
    {
        try {
            $bot = Bot::query()->where('public_key', $request->public_key)->where('private_key', $request->private_key)->first();
            if(empty($bot))
                return ApiHelper::error('module not found');
            return ApiHelper::success($bot->toArray());
        } catch (\Exception $e) {
            return ApiHelper::error($e->getMessage());
        }
    }

    public function update(BotUpdateRequest $request)
    {
        try {
            $bot = Bot::query()->where('public_key', $request->public_key)->where('private_key', $request->private_key)->first();
            if(empty($bot))
                return ApiHelper::error('module not found');
            $bot->version = $request->version;
            $bot->percent = $request->percent;
            $bot->api_key = $request->api_key;
            $bot->category_id = $request->category_id;
            if ($bot->save())
                return ApiHelper::success($bot->toArray());
            return ApiHelper::error('bot not create');
        } catch (\Exception $e) {
            return ApiHelper::error($e->getMessage());
        }
    }
}
