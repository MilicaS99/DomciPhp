<?php

require "db.php";
require "zaduzeni.php";

session_start();
$vracenipodaci = Zaduzeni::VratiSveZaduzene($conn);
if (!$vracenipodaci) {
  echo "Nastala je greška pri učitavanju podatala!";
  die();
}
if ($vracenipodaci->num_rows == 0) {
  echo "Ne postoje zadužena lica";
  die();
} else {


?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link rel="stylesheet" type="text/css" href="maincss/glavna.css">
    <title>Document</title>


    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  </head>

  <body>

    <div class="content">
      <br>
      <h1>
        We can't solve problems by using the same kind of thinking we used
        when we created them.-Albert Einstein</h1>
      <br>

      <div class="row">

        <div align="center">
          <button id="btn-pretraga" class="btn btn-warning btn-block" style="background-color: #6cd8dc; border: 1px solid white;"> Pretrazi kolokvijum</button>
          <input type="text" id="pretraga-input" class="d-none" onkeyup="funkcijaZaPretragu()" placeholder="Pretrazi zadužene po imenu">
        </div>
      </div>
      <br>
      <br>
      <table id="zaduzeni_tabela" class="table table-hover table-striped">
        <thead bgcolor="#6cd8dc">
          <tr class="table-primary">
            <th width="15%">Id</th>
            <th width="15%">Ime</th>
            <th width="15%">Prezime</th>
            <th width="15%">BrojTelefona</th>
            <th width="15%">Email</th>
            <th width="15%">OpisZaduzenja</th>
            <th width="20%">Datum</th>
            <th scope="col" width="5%">Obriši</th>
            <th scope="col" width="5%">Izmeni</th>
          </tr>
        </thead>
        <tbody>
          <?php
          while ($red = $vracenipodaci->fetch_array()) :
          ?>
            <tr>
              <td data-id="Id" data-target="Id"><?php echo $red["Id"] ?></td>
              <td data-id="Id" data-target="Ime"><?php echo $red["Ime"] ?></td>
              <td data-target="Prezime"><?php echo $red["Prezime"] ?></td>
              <td data-target="BrojTelefona"><?php echo $red["BrojTelefona"] ?></td>
              <td data-target="Email"><?php echo $red["Email"] ?></td>
              <td data-target="OpisZaduzenja"><?php echo $red["OpisZaduzenja"] ?></td>
              <td data-target="Datum"><?php echo $red["Datum"] ?></td>

              <td>
                <button id="<?php echo $red["Id"] ?>" name="obrisi" formmethod="post" class="btn btn-danger deleteBtn">Obrisi</button>
              </td>
              <td>
                <button id="<?php echo $red["Id"] ?>" name="izmeni" formmethod="post" class=" btn btn-warning editBtn" data-toggle="modal" data-target="#izmeniModal">Izmeni</button>
              </td>

            </tr>
        <?php
          endwhile;
        }
        ?>
        </tbody>
      </table>
      <br>
      <br>
      <div align="right">
        <button id="btn-dodaj" type="button" class="btn btn-success" data-toggle="modal" data-target="#userModal">Dodaj zaduženo lice</button>
        <br>
        <br>
        <br>
        <button id="btn-sortiraj" onclick="funkcijaSortiraj()" type="button" class="btn btn-success" data-toggle="modal" data-target="#userModal">Sortiraj</button>

      </div>
      <div id="userModal" class="modal fade">
        <div class="modal-dialog">
          <form action="#" method="post" id=dodajZaduzenogform enctype="multipart/form-data">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Dodaj zaduženo lice</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                <label>Ime</label>
                <br>
                <input type="text" name="ime" class="form-control" />
                <br>
                <label>Prezime</label>
                <br>
                <input type="text" name="prezime" class="form-control" />
                <br>
                <label>BrojTelefona</label>
                <br>
                <input type="text" name="brojtelefona" class="form-control" />
                <br>
                <label>Email</label>
                <br>
                <input type="text" name="email" class="form-control" />
                <br>
                <label>OpisZaduzenja</label>
                <br>
                <input type="text" name="opiszaduzenja" class="form-control" />
                <br>
                <label>Datum</label>
                <br>
                <input type="date" name="datum" class="form-control" />
                <br>

                <br>
              </div>
              <div class="modal-footer">
                <input type="hidden" name="zaduzeni_id" id="zaduzeni_id" />
                <input type="hidden" name="operation" id="operation" />
                <input type="submit" name="dodajZaduzenog" id="dodajZaduzenogBtn" class="btn btn-primary" value="Dodaj" />
                <button type="button" class="btn btn-danger" data-dismiss="modal">Zatvori</button>
              </div>
            </div>
          </form>
        </div>
      </div>


      <div id="izmeniModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <form action="#" method="post" id="izmeni_form" enctype="multipart/form-data">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Izmeni podatke o zaduženom licu</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                <label>Ime</label>
                <br>
                <input type="text" id="Ime" name="ime" class="form-control" />
                <br>
                <label>Prezime</label>
                <br>
                <input type="text" id="Prezime" name="prezime" class="form-control" />
                <br>
                <label>BrojTelefona</label>
                <br>
                <input type="text" id="BrojTelefona" name="brojTelefona" class="form-control" />
                <br>
                <label>Email</label>
                <br>
                <input type="text" id="Email" name="email" class="form-control" />
                <br>
                <label>OpisZaduzenja</label>
                <br>
                <input type="text" id="OpisZaduzenja" name="opisZaduzenja" class="form-control" />
                <br>
                <label>Datum</label>
                <br>
                <input type="date" id="Datum" name="datum" class="form-control" />
                <br>
                <br>
              </div>
              <div class="modal-footer">
                <input type="hidden" id="izmenaId" />
                <input type="hidden" name="operation" id="operation" />
                <input type="submit" name="action" id="IzmeniBtn" class="btn btn-primary" value="Izmeni" />
                <button type="button" class="btn btn-danger" data-dismiss="modal">Zatvori</button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <script type="text/javascript">
        $("#dodajZaduzenogBtn").click(function(e) {
          if ($("#dodajZaduzenogform")[0].checkValidity()) {
            debugger;
            e.preventDefault();
            $("#dodajZaduzenogBtn").val('Please Wait...');
            $.ajax({
              url: 'handler/Dodaj.php',
              method: 'post',
              data: $("#dodajZaduzenogform").serialize() + '&action=add_zaduzeni',
              success: function(response) {
                console.log(response);
                $("dodajZaduzenogBtn").val('Dodaj zaduzenog');
                $("#dodajZaduzenogform")[0].reset();
                $("#userModal").hide();
                Swal.fire({
                  title: 'Zaduženi je uspešno dodat',
                  type: 'success'
                });

              }
            });
          }
        });
        $(document).ready(function(e) {

          $(document).on('click', '#btn-dodaj', function(params) {
            $("#userModal")[0].classList.add('show');
          })

          $(document).on('click', '.editBtn', function() {

            var Id = +this.id
            var Ime = $(this).closest('tr').children('td[data-target=Ime]').text();
            var Prezime = $(this).closest('tr').children('td[data-target=Prezime]').text();
            var BrojTelefona = $(this).closest('tr').children('td[data-target=BrojTelefona]').text();
            var Email = $(this).closest('tr').children('td[data-target=Email]').text();
            var OpisZaduzenja = $(this).closest('tr').children('td[data-target=OpisZaduzenja]').text();
            var Datum = $(this).closest('tr').children('td[data-target=Datum]').text();

            $('#Ime').val(Ime);
            $('#Prezime').val(Prezime);
            $('#BrojTelefona').val(BrojTelefona);
            $('#Email').val(Email);
            $('#OpisZaduzenja').val(OpisZaduzenja);
            $('#Datum').val(Datum);
            $('#izmenaId').val(Id);
            $('#izmeniModal')[0].classList.add('show');
          });

          $('#IzmeniBtn').click(function() {

            var Id = +$('#izmenaId').val();
            var Ime = $('#Ime').val();
            var Prezime = $('#Prezime').val();
            var BrojTelefona = $('#BrojTelefona').val();
            var Email = $('#Email').val();
            var OpisZaduzenja = $('#OpisZaduzenja').val();
            var Datum = $('#Datum').val();
            $.ajax({
              url: 'handler/Izmeni.php',
              method: 'post',
              data: $("#izmeni_form").serialize() + '&action=update_zaduzeni',
              success: function(response) {

                console.log(response);
                // $("dodajZaduzenogBtn").val('Dodaj zaduzenog');
                // $("#dodajZaduzenogform")[0].reset();
                // $("#userModal").hide();
                Swal.fire({
                  title: 'Zaduženi je uspešno izmenjen',
                  type: 'success'
                });
              },
              error: function(response) {

              }
            });
          });
        });
        $("body").on("click", ".deleteBtn", function(e) {
          e.preventDefault();
          var element = e.target;
          del_id = +e.target.id;
          Swal.fire({
            title: 'Da li ste sigurni da želite da obrišete zaduženog?',
            text: "Nećete biti u mogućnosti da se vratite na staro!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Da, želim da obrišems!'
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                url: 'handler/Brisanje.php',
                method: 'post',
                data: {
                  'Id': del_id
                },
                success: function(response) {
                  Swal.fire(

                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                  )
                  element.closest('tr').remove();
                }
              });

            }
          })
        });

        $("body").on("click", "#btn-pretraga", function(e) {
          console.log('clicked');
          this.classList.add('d-none')
          var pretragaInput = document.getElementById("pretraga-input");
          pretragaInput.classList.add('d-flex');
        })

        function funkcijaZaPretragu() {
          var input, filter, table, tr, td, i, txtValue;
          input = document.getElementById("pretraga-input");
          filter = input.value.toUpperCase();
          table = document.getElementById("zaduzeni_tabela");
          tr = table.getElementsByTagName("tr");
          for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
              txtValue = td.textContent || td.innerText;

              if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
              } else {
                tr[i].style.display = "none";
              }
            }
          }
        }

        function funkcijaSortiraj() {


          var table, rows, switching, i, x, y, shouldSwitch;
          table = document.getElementById("zaduzeni_tabela");
          switching = true;

          while (switching) {
            switching = false;
            rows = table.rows;
            for (i = 1; i < (rows.length - 1); i++) {
              shouldSwitch = false;
              x = rows[i].getElementsByTagName("td")[1];
              y = rows[i + 1].getElementsByTagName("td")[1];
              if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                shouldSwitch = true;
                break;
              }
            }
            if (shouldSwitch) {
              rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
              switching = true;
            }
          }
        }
      </script>
  </body>

  </html>