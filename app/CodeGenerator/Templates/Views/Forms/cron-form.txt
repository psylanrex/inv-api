

<!-- Form with POST action -->
<form id="makeNewCronForm" action="/api/make-cron" method="post">
        @csrf <!-- CSRF token for Laravel -->

        <div class="form-group">
            <label for="command_name">Command Name</label>
            <input type="text" class="input" id="command_name" name="command_name" value="{{ old('command_name') }}" placeholder="command file name" required>
        </div>

        <div class="form-group">
            <label for="signature">Signature</label>
            <input type="text" class="input" id="signature" name="signature" value="{{ old('signature') }}" placeholder="example: app:trim-cron-logs" required>
        </div>
        
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="input" id="description" name="description" value="{{ old('description') }}" placeholder="description: What the cron does..." required>
        </div>

        <div class="form-group">
            <label for="handler_name">Handler Name</label>
            <input type="text" class="input" id="handler_name" name="handler_name" value="{{ old('handler_name') }}" placeholder="Name of handler class." required>
        </div>

        <div class="form-group">
            <label for="handler_method_name">Handler Method Name</label>
            <input type="text" class="input" id="handler_method_name" name="handler_method_name" value="{{ old('handler_method_name') }}" placeholder="name of the handler method" required>
        </div>

        <div class="form-group">
            <label for="interval">Interval</label>
            <input type="text" class="input" id="interval" name="interval" value="{{ old('interval') }}" placeholder="How often the cron should run. Example:" required>
        </div>

        <button type="submit" class="button is-primary">Submit</button>
    </form>