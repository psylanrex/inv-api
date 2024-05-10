<x-mail::message>
# Introduction

Request Password Reset.

## Click on the button below to reset your password

<x-mail::button :url="$url">
Button Text
</x-mail::button>

If the button doesn't work, use the url below:

{{ $url }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
