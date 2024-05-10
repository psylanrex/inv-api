<!-- Form with POST action -->
<form id="removeProjectForm" action="/api/remove-project" method="post">
        @csrf <!-- CSRF token for Laravel -->

        <button type="submit" class="button is-primary" style="margin-top: 50px;">Remove Project</button>

        
 </form>