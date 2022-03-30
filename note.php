<?php
		session_start();
		$servername = "localhost";
		$username = "root";
		$DBname = "diary";
		$conn = new PDO("mysql:host=$servername;dbname=$DBname;", $username,"", array(PDO::ATTR_PERSISTENT => true));
		$conn->exec("set names utf8");
        $d= isset($_GET['d'])?$_GET['d']:'';
        $_SESSION['selected']= isset($_SESSION['selected'])?$_SESSION['selected']:'';

        $timezone = "Africa/Cairo";
        date_default_timezone_set($timezone);
        $today = date("Y-m-d");

        exec('C:\wamp64\bin\mysql\mysql5.7.19\bin\mysqldump --user='.$username.' --password= --host=localhost diary > E:\backups\diary\"'.$today.'.sql');

        if(isset($_POST['add1']) && $_POST['dia1'] != ''){
            $id= 1;
            $sql="select max(n_id) as m from note";
            $stmt=$conn->query($sql);
            if($row= $stmt->fetch(PDO::FETCH_ASSOC)){
                $id= $row['m'] + 1;
            }
            $false= 0;
            $sql="insert into note(n_id, n_user, n_content, n_done, n_date)
                values(:id, :user, :content, :done, :date)";
            $stmt= $conn->prepare($sql);
            $stmt->execute(array(
                ':id' => $id,
                ':user' => 'حنا',
                ':date' => $_POST['ndate1'],
                ':content' => $_POST['dia1'],
                ':done' => $false));

            $date= $_POST['ndate1'];
            echo' <meta http-equiv="refresh" content="0; url=redirect.php?t=add&date='.$date.'">';
        }
        if(isset($_POST['add2']) && $_POST['dia2'] != ''){
            $id= 1;
            $sql="select max(n_id) as m from note";
            $stmt=$conn->query($sql);
            if($row= $stmt->fetch(PDO::FETCH_ASSOC)){
                $id= $row['m'] + 1;
            }
            $false= 0;
            $sql="insert into note(n_id, n_user, n_content, n_done, n_date)
                values(:id, :user, :content, :done, :date)";
            $stmt= $conn->prepare($sql);
            $stmt->execute(array(
                ':id' => $id,
                ':user' => 'كريستين',
                ':date' => $_POST['ndate2'],
                ':content' => $_POST['dia2'],
                ':done' => $false));

            $date= $_POST['ndate2'];
            echo' <meta http-equiv="refresh" content="0; url=redirect.php?t=add&date='.$date.'">';
        }
        if($d == ''){
            $_SESSION['selected']=  $today;
        }
        $selected= $_SESSION['selected'];
?>
<html>
  <head>
		<meta http-equiv=content-type
 	 content="text/html; charset=utf-8">
 	 <title>النوتة اليومية</title>
	 <style media="screen">
         body{
             background-image: url(pic/weather.png);
         }
         .notes{
            display: flex;
        }
		 .Date{
			 font-size: 20px;
			 width: 15%;
			 margin-left: 42%;
			 margin-right: 42%;
			 margin-bottom: 2%;
			 margin-top: 2%;
		 }
         textarea{
            width: 100%;
            height: 100px;
            padding: 12px 20px;
            box-sizing: border-box;
            border: 2px solid #ccc;
            border-radius: 4px;
            background-color: #f8f8f8;
            font-size: 20px;
            resize: none;
         }
         .n1 , .n2{
            background-image: url(pic/back1.jpg);
            width: 45%;
            height: auto;
            border: 2px solid #ccc;
            border-radius: 6px;
            margin: 10px;
        }
         .n1{
             margin-left: 10%;
         }
         .l1 , .l2{
             border: 1px solid beige;
             background-color: beige;
             border-radius: 10px;
         }
         .button {
			border: none;
			color: white;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			border-radius: 12px;
			cursor:pointer;
            position: relative;
            float: left;
            font-size: 30px;
		}

		.buttonG {
			background-color: white;
			color: black;
			border: 2px solid #4CAF50;
		}
		.buttonG:hover {
			background-color: #4CAF50;
			color: white;
		}
         .table{
             width: 100%;
             font-size: 20px;
             margin-top: 40px;
         }
         .table td{
             opacity: 0.8;
             border: 2px solid dimgrey;
             color: black;
             padding: 15px;
         }
         .table td:hover{
             opacity: 1;
             border-color: black;
         }

        /* Customize the label (the container) */
        .container {
        display: block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 12px;
        cursor: pointer;
        font-size: 22px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        }

        /* Hide the browser's default checkbox */
        .container input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        }

        /* Create a custom checkbox */
        .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 25px;
        width: 25px;
        background-color: dimgray;
        }

        /* On mouse-over, add a grey background color */
        .container:hover input ~ .checkmark {
        background-color: #ccc;
        }

        /* When the checkbox is checked, add a blue background */
        .container input:checked ~ .checkmark {
        background-color: #2196F3;
        }

        /* Create the checkmark/indicator (hidden when not checked) */
        .checkmark:after {
        content: "";
        position: absolute;
        display: none;
        }

        /* Show the checkmark when checked */
        .container input:checked ~ .checkmark:after {
        display: block;
        }

        /* Style the checkmark/indicator */
        .container .checkmark:after {
        left: 9px;
        top: 5px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
        }
         </style>
        </head>

        <script>
          function myFunction() {
              var input, filter, table1, tr1, td1, table2, tr2, td2, i;
              input = document.getElementById("date");
              filter = input.value.toUpperCase();
              table1 = document.getElementById("t1");
              table2 = document.getElementById("t2");
              if(filter){
                table1.style.display = "";
                table2.style.display = "";
                document.getElementById("t11").style.display = "none";
                document.getElementById("t22").style.display = "none";
              } else {
                  table1.style.display = "none";
                  table2.style.display = "none";
              }
              tr1 = table1.getElementsByTagName("tr");
              for (i = 0; i < tr1.length; i++) {
                td1 = tr1[i].getElementsByTagName("td")[1];
                if (td1) {
                  if (td1.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr1[i].style.display = "";
                  } else {
                    tr1[i].style.display = "none";
                  }
                }
              }

              tr2 = table2.getElementsByTagName("tr");
              for (i = 0; i < tr2.length; i++) {
                td2 = tr2[i].getElementsByTagName("td")[1];
                if (td2) {
                  if (td2.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr2[i].style.display = "";
                  } else {
                    tr2[i].style.display = "none";
                  }
                }
              }
          }
            
          function myRedirect(i,d){
              var id= i;
              var date= d;
              document.location.assign("redirect.php?t=done&id="+id+"&date="+date);
              
          }
  </script>

  <body class="body" style="
       text-align:right; font:25px bold Arabic Typesetting; direction:rtl;">

       <form method="post"><input type="date"	name="tdate"	id="date" class="date" value="<?php echo $selected; ?>" oninput="myFunction()"></form>
			 <div class="notes">
				 	<fieldset class="n1">
                        <legend	class="l1">مستر حنا</legend>
                        <form method="post">
                        <textarea name="dia1" required></textarea>
                        <input type="date" name="ndate1" style="font-size:15px; width:auto;" required>
                        <input type="submit" name="add1" class="Button ButtonG" value="اضافة">
                        </form>
                        <table class="table" id="t11">
                        <?php
                            $sql="select * from note where n_user='حنا' and n_date='$selected'";
                            $stmt= $conn->query($sql);
                            while($row= $stmt->fetch(PDO::FETCH_ASSOC)){
                            echo '<tr><td ';
                                if($row['n_done'] == 1)   echo 'style="text-decoration: line-through;"';
                            echo '>';
                            echo $row['n_content'];
                            ?>
                            <form method="post">
                            <div style="position:relative; float:left;">
                                <label class="container">
                                <input type="checkbox" name="done" onclick="myRedirect('<?php echo $row['n_id']; ?>','<?php echo $row['n_date']; ?>')" <?php if($row['n_done']){ ?> checked <?php ;}?> >
                                <span class="checkmark"></span></label>
                            </div></form>
                            <?php
                            echo '</td><td style="display:none;">';
                            echo $row['n_date'];
                            echo '</td></tr>';
                            }
                        ?>
                        </table>
                        <table class="table" id="t1" style="display:none;">
                        <?php
                            $sql="select * from note where n_user='حنا'";
                            $stmt= $conn->query($sql);
                            while($row= $stmt->fetch(PDO::FETCH_ASSOC)){
                            echo '<tr><td ';
                                if($row['n_done'] == 1)   echo 'style="text-decoration: line-through;"';
                            echo '>';
                            echo $row['n_content'];
                            ?>
                            <form method="post">
                            <div style="position:relative; float:left;">
                                <label class="container">
                                <input type="checkbox" name="done" onclick="myRedirect('<?php echo $row['n_id']; ?>','<?php echo $row['n_date']; ?>')" <?php if($row['n_done']){ ?> checked <?php ;}?> >
                                <span class="checkmark"></span></label>
                            </div></form>
                            <?php
                            echo '</td><td style="display:none;">';
                            echo $row['n_date'];
                            echo '</td></tr>';
                            }
                        ?>
                        </table>
					</fieldset>
					<fieldset class="n2">
                        <legend	class="l2">كريستين</legend>
                        <form method="post">
                            <textarea name="dia2" required></textarea>
                            <input type="date" name="ndate2" style="font-size:15px; width:auto;" required>
                            <input type="submit" name="add2" class="Button ButtonG" value="اضافة">
                        </form>
                        <table class="table" id="t22">
                        <?php
                            $sql="select * from note where n_user='كريستين' and n_date='$selected'";
                            $stmt= $conn->query($sql);
                            while($row= $stmt->fetch(PDO::FETCH_ASSOC)){
                            echo '<tr><td ';
                                if($row['n_done'] == 1)   echo 'style="text-decoration: line-through;"';
                            echo '>';
                            echo $row['n_content'];
                            ?>
                            <form method="post">
                            <div style="position:relative; float:left;">
                                <label class="container">
                                <input type="checkbox" name="done" onclick="myRedirect('<?php echo $row['n_id']; ?>','<?php echo $row['n_date']; ?>')" <?php if($row['n_done']){ ?> checked <?php ;}?> >
                                <span class="checkmark"></span></label>
                            </div></form>
                            <?php
                            echo '</td><td style="display:none;">';
                            echo $row['n_date'];
                            echo '</td></tr>';
                            }
                        ?>
                        </table>
                        <table class="table" id="t2" style="display:none;">
                        <?php
                            $sql="select * from note where n_user='كريستين'";
                            $stmt= $conn->query($sql);
                            while($row= $stmt->fetch(PDO::FETCH_ASSOC)){
                            echo '<tr><td ';
                                if($row['n_done'] == 1)   echo 'style="text-decoration: line-through;"';
                            echo '>';
                            echo $row['n_content'];
                            ?>
                            <form method="post">
                            <div style="position:relative; float:left;">
                                <label class="container">
                                <input type="checkbox" name="done" onclick="myRedirect('<?php echo $row['n_id']; ?>','<?php echo $row['n_date']; ?>')" <?php if($row['n_done']){ ?> checked <?php ;}?> >
                                <span class="checkmark"></span></label>
                            </div></form>
                            <?php
                            echo '</td><td style="display:none;">';
                            echo $row['n_date'];
                            echo '</td></tr>';
                            }
                        ?>
                        </table>
					</fieldset>
			 </div>
  </body>
</html>
