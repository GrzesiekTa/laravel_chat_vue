<?php

declare(strict_types=1);

namespace App\Services\User;

use App\Http\Requests\User\UserRequest;
use App\User;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UserService
{
    /**
     * save
     *
     * @param UserRequest $userRequest
     * @param boolean $create
     * 
     * @return User
     */
    public function save(UserRequest $userRequest, bool $create = false): User
    {
        $updateUser = false;

        if ($create) {
            $user = new User();
            //todo password ?? // $id
        } else {
            $updateUser = true;
            $user = auth()->user();
        }

        $user->name = $userRequest->name;
        $avatar = $userRequest->file('avatar');

        if ($avatar) {
            $userAvatarPath = 'users/' . $user->id . '/avatars/';
            $imgName = md5(file_get_contents($avatar->getPathname()));
            $guessExtension = $avatar->guessExtension();

            $resizeSmall = Image::make($avatar)->fit(80)->encode($guessExtension, 100);;
            $resizeBig = Image::make($avatar)->fit(250)->encode($guessExtension, 100);;
            $imageSmallName = $imgName . 'small.' . $guessExtension;
            $imageBigName = $imgName . 'big.' . $guessExtension;

            $images = [
                'avatar' => [
                    'small' => $imageSmallName,
                    'big' => $imageBigName
                ]
            ];

            $user->images = $images;

            Storage::disk('public')->put($userAvatarPath . $imageSmallName, $resizeSmall->__toString());
            Storage::disk('public')->put($userAvatarPath . $imageBigName, $resizeBig->__toString());
        }

        if ($updateUser) {
            $user->save();
        }

        return $user;
    }
}
