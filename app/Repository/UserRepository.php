<?php
namespace App\Repository;

use App\Interface\UserRepositoryInterface;
use App\Models\image;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserRepository implements UserRepositoryInterface
{
    public function index()
    {
        $users = User::all();
        return view('users', compact('users'));
    }

    public function create($type)
    {
        return view('create_user', compact('type'));
    }

    public function store($request)
    {
        DB::begintransaction();
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'bio' => $request->bio,
                'type_user' => $request->type,
                'latitude' => $request->lat,
                'longitude' => $request->lng,
                'date_birth' => $request->date_birth,
            ]);

            if ($request->type == 2) {
                //save image in db
                image::create([
                    'title' => $request->title,
                    'image_name' => $request->document,
                    'imageable_id' => $user->id,
                    'imageable_type' => user::class,
                ]);
            }
            DB::commit();
            flash()->addSuccess('saved successfully');
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $user = User::findorfail($id);

        return view('edit_user', compact('user'));
    }

    public function update($request)
    {
        DB::beginTransaction();
        try {
            $user = User::findorfail($request->id);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'bio' => $request->bio,
                'latitude' => $request->lat,
                'longitude' => $request->lng,
                'date_birth' => $request->date_birth,
            ]);

            if ($request->type_user == 2) {
                $old_image = $request->old_image;
                $new_image = $request->document;

                if ($old_image != $new_image) {
                    // if request have new image that will be delete old image from server
                    $exists = Storage::disk('upload_images')->exists('images/' . $old_image);

                    if ($exists) {
                        Storage::disk('upload_images')->delete('images/' . $old_image);
                    }

                    // update  image in db
                    $user
                        ->image()
                        ->where('image_name', $old_image)
                        ->where('imageable_id', $user->id)
                        ->update([
                            'image_name' => $new_image,
                        ]);
                }
            }
            DB::commit();
            flash()->addSuccess('updated successfully');
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }
    //save image in server
    public function save_image_in_folder($request)
    {
        $file = $request->file('dzfile');
        $file_name = $file->getclientoriginalname();
        $imagePath = $file->storeAs('images', $file_name, 'upload_images');
        return response()->json([
            'name' => $file_name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function destroy($id){

       $user=User::findorfail($id);
        //delete image from server
        if($user->type_user==2){
            $exists = Storage::disk('upload_images')->exists('images/'.$user->image->image_name);

            if ($exists) {
                Storage::disk('upload_images')->delete('images/'.$user->image->image_name);
            }

        //delete images from db
        $user->image->where('imageable_id',$id)->delete();;

        }

        //delete user
        User::destroy($id);
        flash()->adderror('deleted successfully');
        return back();


    }

    public function user_certification($id)
    {
        $user = User::findorfail($id);
        return view('user_certification', compact('user'));
    }
}
