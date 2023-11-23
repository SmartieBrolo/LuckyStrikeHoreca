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
    <div class="headerCenter">{{ $user->name }} - Baan {{ $laneId }}</div>
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
        <tbody id="orderTable">
          <!-- JavaScript table -->
        </tbody>
        <tfoot>
          <tr>
            <td colspan="3" class="noBottomLine">Totaal:</td>
            <td class="price noBottomLine" id="totalPrice">0.00</td>
          </tr>
        </tfoot>
      </table>
    
    
  </main>
  <script>
  // Retrieve order data from localStorage
  const orderJSON = localStorage.getItem('orderData');
  const orderData = JSON.parse(orderJSON);

  const orderTable = document.getElementById('orderTable');
    let totalPrice = 0;

    for (const key in orderData) {
      if (orderData.hasOwnProperty(key)) {
        const item = orderData[key];
        const totalItemPrice = item.price * item.quantity;
        totalPrice += totalItemPrice;

        const row = document.createElement('tr');
        row.innerHTML = `
          <td>${item.item}</td>
          <td>€${item.price.toFixed(2)}</td>
          <td>${item.quantity}</td>
          <td class='price'>€${totalItemPrice.toFixed(2)}</td>
        `;
        orderTable.appendChild(row);
      }
    }

    document.getElementById('totalPrice').textContent = `€${totalPrice.toFixed(2)}`;


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