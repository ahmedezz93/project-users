<?php
namespace App\Interface;
interface UserRepositoryInterface{


    public function index();
    public function create($type);
    public function store($request);
    public function edit($id);
    public function destroy($id);
    public function update($request);
    public function save_image_in_folder($request);
    public function user_certification($id);


}
