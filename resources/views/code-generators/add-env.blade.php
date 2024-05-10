<!DOCTYPE html>
<html lang="en">
@include('code-generators.headers.head')
<body>

<div class="container">


@include('code-generators.headers.links')

    

    <h2 class="mb-4">Add to .ENV</h2>

    <p>This will add ALLOW_SEEDS=true to .env and set mailtrap for email.</p>

    @include('code-generators.forms.add-env-form')


</div>

</body>
</html>