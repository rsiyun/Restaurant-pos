<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <form action="/path-to-your-api-endpoint" method="POST">
        <div>
            <label for="idKasir">Kasir ID:</label>
            <input type="number" id="idKasir" name="idKasir" required>
        </div>
        <div>
            <label for="BuyerName">Buyer Name:</label>
            <input type="text" id="BuyerName" name="BuyerName" required>
        </div>
        <div id="tickets-container">
            <label>Tickets:</label>
            <div class="ticket">
                <label for="slugTicket">Ticket Slug:</label>
                <input type="text" id="slugTicket" name="tickets[0][slugTicket]" required>
            </div>
        </div>
        <button type="button" onclick="addTicket()">Add Another Ticket</button>
        <div>
            <button type="submit">Submit</button>
        </div>
    </form>
</body>

</html>
