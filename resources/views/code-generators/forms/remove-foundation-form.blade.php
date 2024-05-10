<!-- Form with POST action -->
<form id="removeFoundationForm" action="/api/remove-foundation" method="post">
        @csrf <!-- CSRF token for Laravel -->

        <div class="form-group">
            <label for="model">Model</label>
            <input type="text" class="input" id="model" name="model" placeholder="add model name" required>
        </div>

        <div class="form-group">
            <label for="controller_type">Controller Type</label>
            <input type="text" class="input" id="controller_type" name="controller_type" placeholder="Admin, User, etc." required>
        </div>


        <button type="submit" class="button is-primary" style="margin-top: 50px;">Remove Foundation</button>
    </form>