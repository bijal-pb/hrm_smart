<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Setting;

class EmployeeTaskMail extends BaseMail
{
    // use Queueable, SerializesModels;
    public $data;
    public $employee;
    public $setting;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        parent::__construct();
        $this->setting = Setting::first();
        $this->data = $data['data'];
        $this->employee = $data['employee'];
        $this->setMailConfigs();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Employee Tasks')
            ->view('emails.employee_tasks')
            ->with($this->data);
    }
}
