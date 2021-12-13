

$("#dodajZaduzenogBtn").click(function (e) {
  if ($("#dodajZaduzenogform")[0].checkValidity()){
     e.preventDefault();
    $("#dodajZaduzenogBtn").val('Please Wait...');
    $.ajax({
      url:'handler/Dodaj.php',
      method:'post',
      data: $("#dodajZaduzenogform").serialize()+'&action=add_zaduzeni',
      success:function(response){
        console.log(response);
        $("dodajZaduzenogBtn").val('Dodaj zaduzenog');
       
      }
    });
  }
});

