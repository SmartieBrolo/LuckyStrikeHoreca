<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Overview</title>
  @vite(['resources/css/order.css', 'resources/css/header.css'])
</head>
<body>
    <div class="customAlert" id="customAlertBlock">
        <div class="alertContent">
          <p>Bestelling verzonden</p>
          <br>
          <button id="redirectButton">Terug naar horeca pagina</button>
        </div>
      </div>
  <header class="sticky">
    <div class="headerLeft"><a href="/" id="backButton">Terug</a></div>
    <div class="headerCenter">{{ $user->name }} - Baan {{ $userConnect->unique_identifier }}</div>
    <div class="headerRight"><a id="orderButton">Verzend bestelling</a></div>
  </header>
  
  <main>
    <h1>Bestelling overzicht</h1>
    <br>
    <table>
      <thead>
        <tr>
          <th>Item</th>
          <th>Prijs (p/s)</th>
          <th>Aantal</th>
          <th class='price'>Totaal prijs</th>
        </tr>
      </thead>
      <tbody>
        @php
        $totalPrice = 0;
        @endphp
        @dd($orderData);
        {{-- @foreach ($orderJSON as $key => $item)
          @php
          $totalItemPrice = $item['price'] * $item['quantity'];
          $totalPrice += $totalItemPrice;
          @endphp
          <tr>
            <td>{{ $item['item'] }}</td>
            <td>€{{ number_format($item['price'], 2) }}</td>
            <td>{{ $item['quantity'] }}</td>
            <td class='price'>€{{ number_format($totalItemPrice, 2) }}</td>
          </tr>
        @endforeach --}}
        <tr>
          <td colspan="3" class="noBottomLine">Totaal:</td>
          <td class="price noBottomLine" id="totalPrice">€{{ number_format($totalPrice, 2) }}</td>
        </tr>
      </tbody>
    </table>
    
    
  </main>
  <script>
  // Retrieve order data from localStorage
  const orderJSON = localStorage.getItem('orderData');
  const orderData = JSON.parse(orderJSON);
  console.log(orderData);

    document.getElementById('orderButton').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent default behavior of the "Sent Order" button

    var customAlert = document.getElementById('customAlertBlock');
    customAlert.style.display = 'block';
    });

  document.getElementById('redirectButton').addEventListener('click', function(event) {
  event.preventDefault(); // Prevent default behavior of the "Go to Horeca" button

  var customAlert = document.getElementById('customAlertBlock');
  customAlert.style.display = 'none';
  window.location.href = '/';
  });

</script>
</body>
</html>