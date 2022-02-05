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
        <td id="eur-usd" style ="{{ $coins->EURUSD->style }}">{{ $coins->EURUSD->bid }}</td>
        <td id="aud-usd" style ="{{ $coins->AUDUSD->style }}">{{ $coins->AUDUSD->bid }}</td>
        <td id="gbp-usd" style ="{{ $coins->GBPUSD->style }}">{{ $coins->GBPUSD->bid }}</td>
      </tr>
    </tbody>
</table>

<h1 id="hour"> Media analizada em : {{ Session::get('hourMed') }}</h1>
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
        <td id="eur-usd" style ="{{ Session::get('EURUSDStyle') }}">{{ Session::get('EURUSDMed') }}</td>
        <td id="aud-usd" style ="{{ Session::get('AUDUSDStyle') }}">{{ Session::get('AUDUSDMed') }}</td>
        <td id="gbp-usd" style ="{{ Session::get('GBPUSDStyle') }}">{{ Session::get('GBPUSDMed') }}</td>
      </tr>
    </tbody>
</table>
  