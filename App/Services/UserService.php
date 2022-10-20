<?php

namespace App\Services;

use Notihnio\RequestParser\RequestParser;

use App\Models\User;


class UserService
{

    public function post()
    {
        $data = $_POST;

        return User::insert($data);
    }

    public function get($id = null)
    {
        if ($id) {
            return User::select($id);
        } else {
            return User::selectAll();
        }
    }

    public function put()
    {
        $request = RequestParser::parse();
        $data = $request->params;
        return User::put($data);
    }

    public function delete()
    {
        $request = RequestParser::parse();
        $data = $request->params;
        return User::delete($data);
    }
}
