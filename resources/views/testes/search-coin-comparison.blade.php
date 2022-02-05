<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Segundos que são buscados (7 e 37) esses são os intervalos para pegar valores novos. </h2>
    <button onclick="teste()">Iniciar buscas</button>

    <div class="table-element">
      <table class="table">
          <thead>
            <tr>
              <th scope="col">EUR/USD</th>
              <th scope="col">AUD/USD</th>
              <th scope="col">GBP/USD</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td id="eur-usd"></td>
              <td id="aud-usd"></td>
              <td id="gbp-usd"></td>
            </tr>
          </tbody>
        </table>
        <h1 id="hour"></h1>
    </div>

    <form name="form_main">
        <h3>A cada 3 minutos é buscado uma nova analise abaixo vai só vai começar quando der os horarios de atualização.</h3>
      <div>
        <span id="minute">00</span>:<span id="second">00</span>:<span id="millisecond">000</span>
      </div>
    
      <br />
    
      {{-- <button type="button" name="start">start</button>
      <button type="button" name="pause">pause</button>
      <button type="button" name="reset">reset</button> --}}
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script>
        function teste() {
            setInterval(function() {
              var date = new Date();
              if(date.getSeconds() == 37 || date.getSeconds() == 7) {
                getValueCoin()
                start();
              }
            }, 1000);
        }

        function getValueCoin() {
          $.ajax({
              url: "{{ url('getcoins') }}", 
              type: 'get',
              success: function(response){
                  $('.table-element').html(response)
              }, 
              cache: false
          }); 
        }
    </script>
    @include('testes.cronometro')
</body>
</html>