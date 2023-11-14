<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Overview</title>
  @vite(['resources/css/order.css', 'resources/css/header.css'])
</head>
<body>
  <header>
    <div class="header-left">Baan 4</div>
    <div class="header-center">Alwin</div>
    <div class="header-right"><a href="/horeca">Terug</a></div>
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
                <td>Cola</td>
                <td>€2.00</td>
                <td>5</td>
                <td class='price'>€10.00</td>
            </tr>
            <tr>
                <td>Koffie</td>
                <td>€1.00</td>
                <td>4</td>
                <td class='price'>€8.00</td>
            </tr>
            <tr>
                <td>Friet zonder</td>
                <td>€1.50</td>
                <td>10</td>
                <td class='price'>€15.00</td>
            </tr>
            <tr>
                <td>Cola</td>
                <td>€2.00</td>
                <td>5</td>
                <td class='price'>€10.00</td>
            </tr>
            <tr>
                <td>Koffie</td>
                <td>€1.00</td>
                <td>4</td>
                <td class='price'>€8.00</td>
            </tr>
            <tr>
                <td>Friet zonder</td>
                <td>€1.50</td>
                <td>10</td>
                <td class='price'>€15.00</td>
            </tr>
            <tr>
                <td>Cola</td>
                <td>€2.00</td>
                <td>5</td>
                <td class='price'>€10.00</td>
            </tr>
            <tr>
                <td>Koffie</td>
                <td>€1.00</td>
                <td>4</td>
                <td class='price'>€8.00</td>
            </tr>
            <tr>
                <td>Friet zonder</td>
                <td>€1.50</td>
                <td>10</td>
                <td class='price'>€15.00</td>
            </tr>
            <tr>
                <td>Cola</td>
                <td>€2.00</td>
                <td>5</td>
                <td class='price'>€10.00</td>
            </tr>
            <tr>
                <td>Koffie</td>
                <td>€1.00</td>
                <td>4</td>
                <td class='price'>€8.00</td>
            </tr>
            <tr>
                <td>Friet zonder</td>
                <td>€1.50</td>
                <td>10</td>
                <td class='price'>€15.00</td>
            </tr>
            <tr>
                <td>Cola</td>
                <td>€2.00</td>
                <td>5</td>
                <td class='price'>€10.00</td>
            </tr>
            <tr>
                <td>Koffie</td>
                <td>€1.00</td>
                <td>4</td>
                <td class='price'>€8.00</td>
            </tr>
            <tr>
                <td>Friet zonder</td>
                <td>€1.50</td>
                <td>10</td>
                <td class='price'>€15.00</td>
            </tr>
            {{-- @endforeach --}}
            <tr>
                <th colspan="3" class="noBottomLine">Totaal:</th>
                <th class="price noBottomLine">€33.00</th>
            </tr>
            <tr>
                <th colspan="4" class="noBottomLine"><form action="/horeca">
                  <button id="orderButton">Verzend bestelling</button></form></th>
            </tr>
        </tbody>
    </table>
    
    
  </main>
</body>
</html>