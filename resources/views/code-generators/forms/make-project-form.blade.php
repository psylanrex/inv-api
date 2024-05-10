<P style="margin-bottom: 20px;">Please be patient. This can take up to 60 seconds. Don't click away.</p>

<!-- Form with POST action -->
<form id="makeProjectForm" action="/api/make-project" method="post">
        @csrf <!-- CSRF token for Laravel -->

        <button type="submit" class="button is-primary" style="margin-top: 50px;" onclick="showSpinner()">Make Project</button>

        
 </form>