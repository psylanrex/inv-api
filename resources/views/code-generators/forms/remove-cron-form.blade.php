

<!-- Form with POST action -->
<form id="removeCronForm" action="/api/remove-cron" method="post">
        @csrf <!-- CSRF token for Laravel -->

        <div class="form-group">
            <label for="command_name">Command Name</label>
            <input type="text" class="input" id="command_name" name="command_name" value="{{ old('command_name') }}" placeholder="command file name" required>
        </div>

        <div class="form-group">
            <label for="handler_name">Handler Name</label>
            <input type="text" class="input" id="handler_name" name="handler_name" value="{{ old('handler_name') }}" placeholder="Name of handler class." required>
        </div>
 

        <button type="submit" class="button is-primary">Submit</button>
    </form>