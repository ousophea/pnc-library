<!DOCTYPE html>
<html>
<head>
	<title>Email</title>
</head>
<body>
	<!-- <div style="border:1px solid green; padding: 5px;"> -->
	<?php foreach ($send as $key) {
		echo 'Dear '.$key->firstname.' '.$key->lastname.',';
		echo "<br><br>";
		echo 'The return date for the book'.' '.$key->b_title_en.' '.$key->b_title_kh.' '.'was'.' '.$key->bor_return_date.' '.'and is now overpassed.';
		echo "<br><br>";
		echo "Please return the book to PNC library as soon as possible. Sanctions might apply.";
		echo "<br><br>";
		echo "Readingly yours,";
		echo "<br><br>";
		echo "PNC Librarian";
		$this->session->set_userdata('email', $key->email);
		$this->session->set_userdata('name', $key->firstname.' '.$key->lastname);
	 } ?>
	<!-- </div> -->
</body>
</html>