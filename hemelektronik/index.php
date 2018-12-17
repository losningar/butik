<?php
  include 'connection.php';
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Hemelektronik</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">

<br/>
<br/>
<br/>
<br/>         
  <table class="table">
    <thead>
      <tr>
        <th>Artikel nr</th>
        <th>Artikel namn</th>
        <th>Beskrivning</th>
        <th>Kategori</th>
        <th>Pris i kr inkl. moms</th>
        <th>Pris i kr exkl. moms</th>
        <th>Ändra?</th>
      </tr>
    </thead>
    <tbody>
      <?php
          $table  = mysqli_query($connection ,'SELECT * FROM butik WHERE kategori="Hemelektronik"');
          while($row  = mysqli_fetch_array($table)){ ?>
              <tr id="<?php echo $row['id']; ?>">
                <td data-target="artnmr"><?php echo $row['artnmr']; ?></td>
                <td data-target="artnamn"><?php echo $row['artnamn']; ?></td>
                <td data-target="beskrivning"><?php echo $row['beskrivning']; ?></td>
                <td data-target="kategori"><?php echo $row['kategori']; ?></td>
                <td data-target="inklmoms"><?php echo $row['inklmoms']; ?></td>
               <td data-target="exklmoms"><?php echo $row['exklmoms']; ?></td>
                <td><a href="#" data-role="update" data-id="<?php echo $row['id'] ;?>">Klicka här!</a></td>
              </tr>
         <?php }
       ?>
       
    </tbody>
  </table>

  
     </div>
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Redigera produkter</h4>
          </div>
          <div class="modal-body">
              <div class="form-group">
                <label>Artikel nr</label>
                <input type="text" id="artnmr" class="form-control">
              </div>
              <div class="form-group">
                <label>Artikel namn</label>
                <input type="text" id="artnamn" class="form-control">
              </div>
              <div class="form-group">
                <label>Beskrivning</label>
                <input type="text" id="beskrivning" class="form-control">
              </div>
               <div class="form-group">
                <label>Kategori</label>
                <input type="text" id="kategori" class="form-control">
              </div>
              <div class="form-group">
                <label>Pris i kr inkl. moms</label>
                <input type="text" id="inklmoms" class="form-control">
              </div>
              <div class="form-group">
                <label>Pris i kr exkl.moms</label>
                <input type="text" id="exklmoms" class="form-control">
              </div>
                <input type="hidden" id="userId" class="form-control">


          </div>
          <div class="modal-footer">
            <a href="#" id="save" class="btn btn-primary pull-right">Ändra</a>
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Stäng</button>
          </div>
        </div>

      </div>
    </div>

</body>

<script>
  $(document).ready(function(){


      $(document).on('click','a[data-role=update]',function(){
            var id  = $(this).data('id');
            var artnmr = $('#'+id).children('td[data-target=artnmr]').text();
            var artnamn  = $('#'+id).children('td[data-target=artnamn]').text();
            var beskrivning  = $('#'+id).children('td[data-target=beskrivning]').text();
            var kategori  = $('#'+id).children('td[data-target=kategori]').text();
            var inklmoms  = $('#'+id).children('td[data-target=inklmoms]').text();
            var exklmoms  = $('#'+id).children('td[data-target=exklmoms]').text();

            $('#artnmr').val(artnmr);
            $('#artnamn').val(artnamn);
            $('#beskrivning').val(beskrivning);
            $('#kategori').val(kategori);
            $('#inklmoms').val(inklmoms);
            $('#exklmoms').val(exklmoms);
            $('#userId').val(id);
            $('#myModal').modal('toggle');
      });


       $('#save').click(function(){
          var id  = $('#userId').val(); 
         var artnmr =  $('#artnmr').val();
         var artnamn =  $('#artnamn').val();
         var beskrivning =   $('#beskrivning').val();
         var kategori =   $('#kategori').val();
         var inklmoms =   $('#inklmoms').val();
         var exklmoms =   $('#exklmoms').val();


          $.ajax({
              url      : 'connection.php',
              method   : 'post', 
              data     : {artnmr : artnmr , artnamn: artnamn , beskrivning : beskrivning , id: id , kategori : kategori , inklmoms : inklmoms, exklmoms : exklmoms},
              success  : function(response){
          		$('#'+id).children('td[data-target=artnmr]').text(artnmr);
            	$('#'+id).children('td[data-target=artnamn]').text(artnamn);
          		$('#'+id).children('td[data-target=beskrivning]').text(beskrivning);
       		    $('#'+id).children('td[data-target=kategori]').text(kategori);
      		    $('#'+id).children('td[data-target=inklmoms]').text(inklmoms);
    		      $('#'+id).children('td[data-target=exklmoms]').text(exklmoms);
                       $('#myModal').modal('toggle'); 

                         }
          });
       });
  });
</script>
</html>
