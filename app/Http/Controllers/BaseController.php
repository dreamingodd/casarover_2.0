<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Content;
use App\Attachment;

class BaseController extends Controller
{

    /**
     * Create an Attachment in database.
     * @param $filepath filename
     * @return Attachment
     */
    protected function createAttachment($filepath) {
        $attachment = new Attachment;
        $attachment->filepath = $filepath;
        $attachment->save();
        return $attachment;
    }

    /**
     * Convert the content data that are received from edit page
     * to Contents which are from the database.
     * @param contents Array of content[name, text, photo]
     * @return Array of entity Contents(which are already inserted in the databases)
     */
     protected function createContents(Array $rawContents) {
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
}
