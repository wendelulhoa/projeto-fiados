<tr>
<td class="header">
<a href="{{ Route('index') }}" style="display: inline-block;">
@if (trim($slot) === 'Ulhoa-mods')
<img src="{{ Route('index') }}/images/logo.png" class="logo" alt="{{ config('app.name') }}">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
