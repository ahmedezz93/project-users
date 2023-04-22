<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Interface\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $users;

    public function __construct(UserRepositoryInterface $users)
    {
        $this->users = $users;
    }

    public function index()
    {
        return $this->users->index();
    }

    public function create($type)
    {
        return $this->users->create($type);
    }

    public function store(UserRequest $request)
    {
        $request->validated();
        return $this->users->store($request);
    }

    public function edit($id)
    {
        return $this->users->edit($id);
    }


    public function destroy($id)
    {
        return $this->users->destroy($id);
    }


    public function update(UserRequest $request)
    {
        $request->validated();
        return $this->users->update($request);
    }


    public function save_image_in_folder(Request $request)
    {
        return $this->users->save_image_in_folder($request);
    }



    public function user_certification($id)
    {
        return $this->users->user_certification($id);
    }
}
