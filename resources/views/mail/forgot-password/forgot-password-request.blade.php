<x-mail::message>
# Password Reset

We have received your request to reset your password.

<x-mail::button :url="$url">

Click here to reset your password

</x-mail::button>

You may also use the url below:

{{ $url }}

Thanks,<br>
Invitory Support
</x-mail::message>
