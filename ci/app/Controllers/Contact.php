<?php

namespace App\Controllers;

class Contact extends BaseController
{
	public function index($a = "")
	{
        $data = [
            "thisController" => $this,
        ];

        $page = $this->eleModel->getAll([
            "type_id" => 47,
            "lang_id" => $this->current_lang_id,
            "where" => [["eles", "active", "=", 1,], ["eles", "id", "=", 350,]],
            "orderby" => "eles.orderNumber",
        ]);
        $page = assignWhFiles($this, $page);

        $data["page"] = $page;
        loadpage("contact", $data);
    }

    public function send() {

	    $receiverMail = 'webdeveloper.mucahitcoban@gmail.com';

        $request = service('request');
        $name = $request->getPost('name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = $request->getPost('email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $subject = $request->getPost('subject', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $message = $request->getPost('message', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $db = \Config\Database::connect();

        $data = [
            'name'  => $name,
            'email'  => $email,
            'subject'  => $subject,
            'message'  => $message,
            'datetime'  => date('Y-m-d H:i:s'),
        ];

        $db->table('inbox')->insert($data);

//	    include FCPATH . '../ci_nesibe/PHPMailer/sendmail.php';
//	    include  FCPATH . '../ci_nesibe/PHPMailer/templates/template_a.php';

//        $body = getTemplate($name, $email, $subject, $message);
//	    send_the_mail($receiverMail, 'A Message has been received', $body);

        $session = session();
        $session->setFlashdata('form_is_successfull', '1');

        return redirect()->to(base_url() . '/contact');

    }

}
