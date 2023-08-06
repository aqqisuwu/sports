<h1>SPORTS COURT BOOKING SYSTEM</h1>
<p>Dear {{ $reservation->first_name }},</p>
<p>Your reservation has been confirmed. Here are the details of your reservation:</p>
<p>Slot ID: {{ $reservation->slot_id }}</p>
<p>Date: {{ $reservation->res_date }}</p>
<p>Court: {{ $reservation->slot->name }}</p>
<p>Location: {{ $reservation->slot->location }}</p>
<br>
<p>Thank you for choosing our Sports Court Booking System. </p>
<p>We hope you enjoy your sport session! Gear Up!</p>
<br>
<br>
<p>If you have any questions or need further assistance, please don't hesitate to contact Court Administrator at https://wa.link/49mhqg </p> 
