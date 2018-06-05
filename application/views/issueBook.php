<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html>
<head>
<title>Issue Book</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/bootstrap.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

function issueReturnBook(book_id, type){
  var url;
   if(type == 'issue'){
        url ='<?php echo base_url(); ?>'+'books/issue_book';       
   }
   
   if(type == 'return'){
        url ='<?php echo base_url(); ?>'+'books/return_book';       
   }
    $.ajax({
      url: url,
      type: 'POST',
      data: {'id':book_id},
      success: function (response) {
          var json = $.parseJSON(response);
          alert(json.message)
      },
      error: function( jqXhr ) {
          console.log(jqXhr);
      }
});

}
</script>
</head>
<body>

<div id="container">
<table class="table table-striped table-responsive table-bordered">
  <thead class="thead-dark">
    <tr>
      <th scope="row">Sr No</th>
      <td>Book Name</td>
      <td>Actions</td>
    </tr>
  </thead>
  <tbody>
      <?php foreach ($book_list as $key => $value) {?>
        <th scope="row"><?php echo $key+1; ?></th>
        <td><?php echo $value['book_name'] ?></td>    
        <td>            
            <button class="btn-default" onclick="issueReturnBook('<?php echo $value['id']; ?>','issue')">Issue Book</button>
            <button class="btn-default" onclick="issueReturnBook('<?php echo $value['id']; ?>','return')">Return Book</button>
        </td>    
      <tr>
      <?php } ?>
    
    </tr>
  </tbody>
</table>
</div>
    
  
</body>
</html>