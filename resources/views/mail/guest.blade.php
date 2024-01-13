<h1>{{ $event->name }}</h1>
<p>Thank you for buying a ticket (contact E-Mail: {{ $event->contact }}). <br /><br />

The information about Your ticket are available on:
<h3><a href="http://example.org/{{ $event->slug }}/{{ $sha }}">http://example.org/{{ $event->slug }}/{{ $sha }}</a></h3>

If you don't have an account, here is Your ticket's PIN code to access it: {{ $pin }}.</p>
