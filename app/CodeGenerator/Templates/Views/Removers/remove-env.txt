<!DOCTYPE html>
<html lang="en">
@include('code-generators.headers.head')
<body>

<div class="container">


@include('code-generators.headers.links')

    <h2 class="mb-4">Remove From .ENV</h2>

    <p>This will remove ALLOW_SEEDS=true from .env.</p>

    @include('code-generators.forms.remove-env-form')


</div>

</body>
</html>