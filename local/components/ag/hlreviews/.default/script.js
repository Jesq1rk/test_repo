$(document).ready(function(){
  $("#submit_review").submit(function(event){
  event.preventDefault();
  $.ajax({
    type: 'POST',
    url: '/ajax/add_hl_block_element.php',
    data: $('#submit_review').serialize(),
    success: function(data){

    }
  });
});
});
