<?php

namespace App\Helpers;

use App\Models\Admins\InviteSeller;
use App\Mail\InviteCreated;
use Illuminate\Support\Facades\Mail;

class Invite
{
   

    public static function generateToken()
    {
        $token = bin2hex(openssl_random_pseudo_bytes(32));
        return $token;
    }
}

// if (! function_exists('invite')) {
//     function invite($name, $surname, $email, $seller_company_id)
//     {
    // $invite = Invite::where('invite',$request->invite)->get();
    // if($invite->count() == 0){
    //     return 'Ooops';
    // }
//         do {
//             //сгенерируем рандомную строку при помощи функции помощника Laravel  `str_random`
//             $token = str_random(10);
//         } // Проверим, нет ли уже такого токена, если есть сгенерим заново
//         while (InviteSeller::where('code', $token)->first());
//         //создадим запись приглашения
//         $invite = InviteSeller::create([
//             'email' => $email,
//             'token' => $token
//         ]);


//         Mail::to($email)->send(new InviteCreated($invite, $name, $surname, $seller_company_id, $token));

//         return ('sent');
//     }
// }
