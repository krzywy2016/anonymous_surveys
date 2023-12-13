<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
@else
<a href="/">
    <img src="{{asset('logo.png')}}" height="50px" />
</a>
@endif
</a>
</td>
</tr>
