<?php

$data = json_decode(file_get_contents('php://input'), true);
if(isset($data)) {

$adminMail = "abiwaseda@gmail.com";
$to = $data['mailaddress'];
$companyname = $data['companyname'];
$companyaddress = $data['companyaddress'];
$name = $data['name'];
$snsaccount = $data['snsaccount'];
$message = $data['message'];

$subject = "応募の詳細";

$body = "
<html>
<head>
<title>HTML email</title>
</head>
<body>
<div>
<label><b>会社名</b></label>
<p>{{companyname}}</p>
</div>
<div>
<label><b>会社住所</b></label>
<p>{{companyaddress}}</p>
</div>
<div>
<label><b>名前</b></label>
<p>{{name}}</p>
</div>
<div>
<label><b>メールアドレス</b></label>
<p>{{mailaddress}}</p>
</div>
<div>
<label><b>SNSアカウント</b></label>
<p>{{snsaccount}}</p>
</div>
<div>
<label<b>応募動機</b></label>
<p>{{message}}</p>
</div>
</body>
</html>
";

$body = str_replace("{{companyname}}", $companyname, $body);
$body = str_replace("{{companyaddress}}", $companyaddress, $body);
$body = str_replace("{{name}}", $name, $body);
$body = str_replace("{{mailaddress}}", $to, $body);
$body = str_replace("{{snsaccount}}", $snsaccount, $body);
$body = str_replace("{{message}}", $message, $body);

$body_customer = "
<html>
<head>
<title>HTML email</title>
</head>
<body>
<p>
この度は、{{campaign}} にご応募いただきまして誠にありがとうございます。<br>
応募者多数により書類選考に（）お時間をいただいております。<br>
誠に恐れ入りますが、今しばらくお待ちいただけますようお願いいたします。<br>
なお、結果につきましては、通過者のみのご連絡とさせていただきます。<br>
何卒ご了承ください。<br>
（企業名）<br>
</p>
</body>
</html>
";

//print_r($body);
//exit;

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <support@yamacity.com>' . "\r\n";
//$headers .= 'Cc: myboss@example.com' . "\r\n";

mail($adminMail,$subject,$body,$headers);
mail($to,$subject,$body_customer,$headers);
}
?>