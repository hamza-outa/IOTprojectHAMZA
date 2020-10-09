<html>

<head>

  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

  <?php
// Include configuration file
require_once 'config.php';//hier de link zetten

// Include User class
require_once 'user_class.php';

// Initialize User class
$user = new User();

  // Get members data from database
  $members = $user->getRows();
  ?>
  <!-- TEST -->
  <form method="post" action="" id="contactform">


      <p>vul een naam in: <input type="text"  id="name"></p>
      <p>vul een nummer in: <input type="text"  id="number"></p>
      <p>vul een gsm nummer in: <input type="text"  id="phone"></p>


    <button type="submit" id="indienen">Submit</button>
  </form>

<!-- TEST -->
  <div class="search-panel">
      <div class="input-group">
          <input type="text" class="search form-control" id="searchInput" placeholder="By name or number">
          <div class="input-group-append">
              <button class="btn btn-outline-secondary" type="button" onclick="searchFilter();">Search</button>
          </div>
      </div>
      <div class="form-group">
          <select class="form-control" id="filterSelect" onchange="searchFilter();">
              <option value="">Sort By</option>
              <option value="new">Newest</option>
              <option value="asc">Ascending</option>
              <option value="desc">Descending</option>
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
          </select>
      </div>
  </div>

  <div class="main-content">
      <div class="loading-overlay" style="display: none;"><div class="overlay-content">Loading.....</div></div>
      <table class="table table-striped">
          <thead>
              <tr>
                  <th>#</th>
                  <th>id</th>
                  <th>name</th>
                  <th>number</th>
                  <th>phone</th>
              </tr>
          </thead>
          <tbody id="userData">
              <?php
              if(!empty($members)){ $i = 0;
                  foreach($members as $row){ $i++;
              ?>
              <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $row['id']; ?></td>
                  <td><?php echo $row['name']; ?></td>
                  <td><?php echo $row['numbVal']; ?></td>
                  <td><?php echo $row['phone']; ?></td>
              </tr>
              <?php } }else{ ?>
              <tr><td colspan="7">No member(s) found...</td></tr>
              <?php } ?>
          </tbody>
      </table>
  </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script>
    function searchFilter(){
      $.ajax({
          type: 'POST',
          url: 'http://11900456.pxl-ea-ict.be/test/getData.php',
          data: 'keywords='+$('#searchInput').val()+'&filter='+$('#filterSelect').val(),
          beforeSend: function(){
              $('.loading-overlay').show();
          },
          success:function(html){
              $('.loading-overlay').hide();
              $('#userData').html(html);
          }
      });
    }
    //TEST
    $(document).ready(function () {                     //als de document geladen is moet je dit uitvoeren
      $('#indienen').click(function (e) {               // wanneer op de submit knop is gedrukt start de functie
        e.preventDefault();                             // idunno
        var name = $('#name').val();                    //pakt de gegevens die je ingevult hebt en steekt in een var
        var number = $('#number').val();
        var phone = $('#phone').val();
        $.ajax                                          //dit is de ajax stuk die de data naar de form php stuurt om te verwerken
          ({
            type: "POST",
            url: "http://11900456.pxl-ea-ict.be/ajx/form_submit.php",
            data: { "name": name, "number": number, "phone": phone },
            success: function (data) {
              $('#result').html(data);                    //de resultaten v/d ingevulde waardes worden gedisplayed TER CONTROLE
              $('#contactform')[0].reset();               //idunno
            }
          });
      });
    });

    var updateTable = setInterval( updatetable, 300000 ); //update de tabel elke seconde
    function updatetable() {                              //functie die tabel update
  		$.get("getData.php", function(data) {          //vraag de tabel op. deze php print de gegevens al
  			console.log(data);                                //CONTROLE
  			$("#userData").html(data);                           //pak de echos van de php file en steek die in de div
  		});
    }
    //TEST
  </script>
</body>

</html>
