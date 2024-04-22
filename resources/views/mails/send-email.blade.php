<x-mail::message>
# {{ $content['subject'] }}

{{ $content['message'] }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
