<?php

namespace App\Http\Controllers;

use App\Attachment;
use App\Content;
use App\Entity\User;

/** Some shared methods are here. */
abstract class BaseController extends Controller
{

    /**
     * Create an Attachment in database.
     * @param string $filepath filename
     * @return Attachment
     */
    protected function createAttachment($filepath)
    {
        $attachment = new Attachment;
        $attachment->filepath = $filepath;
        $attachment->save();
        return $attachment;
    }

    /**
     * Convert the content data that are received from edit page
     * to Contents which are from the database.
     * @param array $rawContents Array of content[name, text, photo]
     * @return array of entity Contents(which are already inserted in the databases)
     */
     protected function createContents(Array $rawContents)
     {
         $contents = array();
         foreach ($rawContents as $rawContent) {
             $content = new Content;
             $content->name = $rawContent->name;
             $content->text = $rawContent->text;
             $attachments = array();
             foreach ($rawContent->photos as $filepath) {
                 $attachemnt = $this->createAttachment($filepath);
                 array_push($attachments, $attachemnt);
             }
             $content->save();
             $content->attachments()->saveMany($attachments);
             array_push($contents, $content);
         }
         return $contents;
     }

     /**
      * Check nullity of parameters and save them in database.
      * @param int $userId
      * @param string $username
      * @param string $cellphone
      * @return bool success or not
      */
     protected function checkThenSaveUsernameAndCellphone($userId, $username, $cellphone)
     {
         if (empty($username) || empty($cellphone)) {
             return false;
         } else {
             $user = User::find($userId);
             if ($user->realname != $username or $user->cellphone != $cellphone) {
                 $user->realname = $username;
                 $user->cellphone = $cellphone;
                 $user->address = $address;
                 $user->save();
             }
             return true;
         }
     }
}
