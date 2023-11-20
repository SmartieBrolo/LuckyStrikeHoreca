<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Overview</title>
  @vite(['resources/css/order.css', 'resources/css/header.css'])
</head>
<body>
    <div class="custom-alert" id="customAlert">
        <div class="alert-content">
          <p>Bestelling verzonden</p>
          <br>
          <button id="redirectButton">Terug naar horeca pagina</button>
        </div>
      </div>
  <header>
    <div class="header-left">Baan 4</div>
    <div class="header-center">Donny en Walter</div>
    <div class="header-right"><a href="/home">Terug</a></div>
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
                <th class="price">Totaal prijs</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach($cateringItem->items as $item) --}}
            {{-- <tr>
                <td>{{ $item->name }}</td>
                <td>${{ $item->price }}</td>
                <td>{{ $item->quantity }}</td>
                <td>${{ $item->price * $item->quantity }}</td>
            </tr> --}}
            <tr>
                <td>Koffie</td>
                <td>€1.00</td>
                <td>1</td>
                <td class='price'>€1.00</td>
            </tr>
            <tr>
                <td>Thee</td>
                <td>€1.00</td>
                <td>2</td>
                <td class='price'>€2.00</td>
            </tr>
            <tr>
                <td>Chocomelk</td>
                <td>€1.50</td>
                <td>1</td>
                <td class='price'>€1.50</td>
            </tr>
            <tr>
                <td>Cola</td>
                <td>€2.00</td>
                <td>3</td>
                <td class='price'>€6.00</td>
            </tr>
            <tr>
                <td>Fanta</td>
                <td>€2.00</td>
                <td>4</td>
                <td class='price'>€8.00</td>
            </tr>
            <tr>
                <td>Ginger ale</td>
                <td>€2.25</td>
                <td>2</td>
                <td class='price'>€4.50</td>
            </tr>
            <tr>
                <td>Pitcher Ranja (1.5L)</td>
                <td>€1.00</td>
                <td>1</td>
                <td class='price'>€1.00</td>
            </tr>
            <tr>
                <td>Bier (tap)</td>
                <td>€2.00</td>
                <td>6</td>
                <td class='price'>€12.00</td>
            </tr>
            <tr>
                <td>Weizener</td>
                <td>€3.50</td>
                <td>2</td>
                <td class='price'>€7.00</td>
            </tr>
            <tr>
                <td>Zakje naturel chips</td>
                <td>€0.75</td>
                <td>1</td>
                <td class='price'>€0.75</td>
            </tr>
            <tr>
                <td>Supertje</td>
                <td>€2.75</td>
                <td>4</td>
                <td class='price'>€11.00</td>
            </tr>
            <tr>
                <td>Ketchup</td>
                <td>€0.25</td>
                <td>2</td>
                <td class='price'>€0.50</td>
            </tr>
            <tr>
                <td>Frikandel</td>
                <td>€1.25</td>
                <td>5</td>
                <td class='price'>€6.25</td>
            </tr>
            <tr>
                <td>Mexicano</td>
                <td>€1.75</td>
                <td>4</td>
                <td class='price'>€7.00</td>
            </tr>
            <tr>
                <td>Vlammetjes (12 stuks)</td>
                <td>€6.00</td>
                <td>2</td>
                <td class='price'>€12.00</td>
            </tr>
            {{-- @endforeach --}}
            <tr>
                <th colspan="3" class="noBottomLine">Totaal:</th>
                <th class="price noBottomLine">€80.50</th>
            </tr>
            <tr>
                <th colspan="4" class="noBottomLine"><form action="">
                  <button id="orderButton">Verzend bestelling</button>
                </form></th>
            </tr>
        </tbody>
    </table>
    
    
  </main>
  <script>
document.getElementById('orderButton').addEventListener('click', function(event) {
  event.preventDefault(); // Prevent default behavior of the "Sent Order" button

  var customAlert = document.getElementById('customAlert');
  customAlert.style.display = 'block';
});

document.getElementById('redirectButton').addEventListener('click', function(event) {
  event.preventDefault(); // Prevent default behavior of the "Go to Horeca" button

  var customAlert = document.getElementById('customAlert');
  customAlert.style.display = 'none';
  window.location.href = '/home';
});
  </script>
</body>
</html>