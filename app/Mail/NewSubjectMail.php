<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewSubjectMail extends Mailable
{
    use Queueable, SerializesModels;

	public $data;
	
	public function __construct($data)
    {
		$this->data = $data;
    }
	
    public function build()
    {
		return $this->from(config('app.email'), config('app.name'))
			->replyTo(config('app.email'))
			->view('mails.new_subject_mail')
			->text('mails.new_subject_mail_plain')
			->subject('New subject suggested')
			->with(
				[
					'newSubject' => $this->data->newSubject,
					'tutorID' => $this->data->tutorID,
				]);
    }
}
