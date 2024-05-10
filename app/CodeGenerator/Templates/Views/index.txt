@include('code-generators.headers.head')
<body>

<div class="container">

@if(session('message'))
    <div class="notification is-success">
        {{ session('message') }}
    </div>
@endif


@include('code-generators.headers.links')



</div>

</body>
</html>
