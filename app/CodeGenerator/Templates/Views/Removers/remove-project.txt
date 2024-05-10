<!DOCTYPE html>
<html lang="en">
@include('code-generators.headers.head')
<body>

<div class="container">


@include('code-generators.headers.links')  

    <h2 class="mb-4">Remove Project</h2>

    <p>This will remove all project folders and files, except views.</p>

    @include('code-generators.forms.remove-project-form')


</div>

</body>
</html>