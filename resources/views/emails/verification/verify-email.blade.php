<x-mail::message>
# Introduction

Please verify your email for base.

<x-mail::button :url="$url">
Button Text
</x-mail::button>

{{$url}}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
