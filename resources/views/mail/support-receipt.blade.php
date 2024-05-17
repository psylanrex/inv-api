<x-mail::message>
# Support Receipt

Hi {{ $name }}, we have received your support request for the following reason: 
    
{{ $reason }}

{{ $message }}

We will get back to you as soon as possible.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
