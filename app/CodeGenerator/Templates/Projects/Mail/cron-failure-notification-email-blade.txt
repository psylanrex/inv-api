<x-mail::message>
# You have a failed Cron Job.

The {{ $cron_name }} cron failed. Please note you will only get this message once per day. 

The failure is as follows:

{{ $cron_failure_details }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
