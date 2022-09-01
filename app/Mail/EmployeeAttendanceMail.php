<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Setting;

class EmployeeAttendanceMail extends BaseMail
{
    // use Queueable, SerializesModels;
    public $data;
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
        $this->setMailConfigs();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Employee Attendance')
            ->view('emails.employee_attendance')
            ->with($this->data);
    }
}
