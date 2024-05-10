<!-- Form with POST action -->
<form id="addEnvForm" action="/api/add-env" method="post">
        @csrf <!-- CSRF token for Laravel -->

        <button type="submit" class="button is-primary" style="margin-top: 50px;">Add .ENV</button>

        
 </form>