<!-- Form with POST action -->
<form id="removeEnvForm" action="/api/remove-env" method="post">
        @csrf <!-- CSRF token for Laravel -->

        <button type="submit" class="button is-primary" style="margin-top: 50px;">Restore .ENV To Default</button>
      
 </form>