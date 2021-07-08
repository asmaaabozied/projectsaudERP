<?php include('config.php');

?>
<?php


$daaat = date('d/m/Y h:i:s a', time());


if (isset($_POST["submit"])) {
//    print_r('ggf');exit;


    require_once('vendor/php-excel-reader/excel_reader2.php');
    require_once('vendor/SpreadsheetReader.php');


//    $allowedFileType
//  $allowedFileType = ['xls','application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

//  if(in_array($_FILES["file"]["type"],$allowedFileType)){
//      print_r('ggf');exit;
    //     $targetPath = '/home/alfadieg/public_html/application/modules/uploads/views/excel/'.$_FILES['file']['name'];
    $_path = "E:/home/xampp/htdocs/thewaysauda/asmaa/public/modules/excel/";
    $targetPath = $_path . $_FILES['file']['name'];
//
//    print_r($targetPath);

    move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
//    print_r($targetPath);exit;
    $Reader = new SpreadsheetReader($targetPath);
//    print_r($Reader);exit;
    $sheetCount = count($Reader->sheets());

    for ($i = 0; $i < $sheetCount; $i++) {
        $Reader->ChangeSheet($i);

        $previous = 0;
        $previous_date = 0;
        $f = 0;
        foreach ($Reader as $Row) {
            //        If($f == 0) {$f++;continue; }


//            $added_by = $_POST["added_by"];
//            $dept_id = $_POST["dept_id"];

            if ($previous != mysqli_real_escape_string($conn, $Row[0])) {
                print_r($data3);exit;

                $data3['registration_number'] = mysqli_real_escape_string($conn, $Row[0]);

                $data3['date'] = mysqli_real_escape_string($conn, $Row[1]);

                $data3['branch'] = mysqli_real_escape_string($conn, $Row[2]);
                $data3['notes'] = mysqli_real_escape_string($conn, $Row[3]);
                $data3['created_at'] = date('Y-m-d');

                $previous_date = mysqli_real_escape_string($conn, $Row[1]);

                $in_1 = (int)mysqli_real_escape_string($conn, $Row[4]);
                $query11 = "select * from accounts where accounts.acc_id=$in_1";
                $result4 = mysqli_query($conn, $query11);
                if (mysqli_num_rows($result4) > 0) {
                    $trees = mysqli_fetch_assoc($result4);

                }

                //     $data['acc_id']   = $trees['tree_id'];

                $query = "insert into transactions"
                    . "(`registration_number`, `date`,`branch`, `notes`, `created_at`) VALUES "
                    . " (" . $data3['registration_number'] . ", '" . $data3['date'] . "','" . $data3['branch'] . "'," . $data3['notes'] . "," . $data3['created_at'] . ")";
                //$query = "update items set sale_price=$sale_price,puy_price=$puy_price,expiration_duration=$expiration_duration where items.id=$id";
                mysqli_query($conn, "SET NAMES 'utf8'");
                mysqli_query($conn, 'SET CHARACTER SET utf8');
                mysqli_set_charset($conn, 'utf8');
                $result = mysqli_query($conn, $query);


//                $data2['day_date'] = mysqli_real_escape_string($conn, $Row[1]);

//                $data2['account'] = $trees['tree_id'];

//                $data2['type'] = mysqli_real_escape_string($conn, $Row[5]);
//                $data2['descr'] = mysqli_real_escape_string($conn, $Row[6]);
//                $data2['value'] = mysqli_real_escape_string($conn, $Row[7]);
//                $data2['day_form_id'] = (int)$form_id;
//                $data2['added_by'] = $added_by;

//                $query1 = "insert into day_forms "
//                    . "(`day_date`, `account`,`type`, `descr`, `value`, `day_form_id`,`added_by`) VALUES "
//                    . " (" . $data2['day_date'] . ", '" . $data2['account'] . "','" . $data2['type'] . "','" . $data2['descr'] . "'," . $data2['value'] . "," . $data2['day_form_id'] . "," . $data2['added_by'] . ")";

//                mysqli_query($conn, "SET NAMES 'utf8'");
//                mysqli_query($conn, 'SET CHARACTER SET utf8');
//                mysqli_set_charset($conn, 'utf8');
//                $result = mysqli_query($conn, $query1);


                if (!empty($result)) {
                    $type = "success";
                    $message = "تم استيراد القيود بنجاح";
                } else {
                    $type = "error";
                    $message = "خطأ باستيراد القيود";
                }
            } else {

//                $data2['day_date'] = $previous_date;
//                $in_1 = (int)mysqli_real_escape_string($conn, $Row[4]);
//                $query11 = "select * from accounts where accounts.acc_id=$in_1";
//                $result4 = mysqli_query($conn, $query11);
//                if (mysqli_num_rows($result4) > 0) {
//                    $trees = mysqli_fetch_assoc($result4);
//
//                }
//                $data2['account'] = $trees['tree_id'];
//
//                $data2['type'] = mysqli_real_escape_string($conn, $Row[5]);
//                $data2['descr'] = mysqli_real_escape_string($conn, $Row[6]);
//                $data2['value'] = mysqli_real_escape_string($conn, $Row[7]);
//                $data2['day_form_id'] = (int)$previous;

//                $data2['added_by'] = $added_by;

//                $query1 = "insert into day_forms "
//                    . "(`day_date`, `account`,`type`, `descr`, `value`, `day_form_id`,`added_by`) VALUES "
//                    . " (" . $data2['day_date'] . ", '" . $data2['account'] . "','" . $data2['type'] . "','" . $data2['descr'] . "'," . $data2['value'] . "," . $data2['day_form_id'] . "," . $data2['added_by'] . ")";
//                mysqli_query($conn, "SET NAMES 'utf8'");
//                mysqli_query($conn, 'SET CHARACTER SET utf8');
//                mysqli_set_charset($conn, 'utf8');
//                $result = mysqli_query($conn, $query1);


                if (!empty($result)) {
                    $type = "success";
                    $message = "تم استيراد القيود بنجاح";
                } else {
                    $type = "error";
                    $message = "خطأ باستيراد القيود";
                }
            }

            $f++;
        }

    }
//  }
//  else
//  {
//
//        $type = "error";
//        $message = "خطأ بنوع الملف برجاء تحميل ملف اكسيل";   print_r($message);exit;
//  }

    echo '<script type="text/javascript">
           window.location = "http://localhost:8000/admin/daily"
      </script>';


}

?>
