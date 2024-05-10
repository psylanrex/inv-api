<!-- Form with POST action -->
<form id="makeNewServiceForm" action="/api/make-new-service" method="post">
        @csrf <!-- CSRF token for Laravel -->

        <div class="form-group">
            <label for="service_name">Service Name</label>
            <input type="text" class="input" id="service_name" name="service_name" value="{{ old('service_name') }}" placeholder="service name ex: AvatarUserService" required>
        </div>

        <div class="form-group">
            <label for="input2">Service Folder Name</label>
            <input type="text" class="input" id="service_folder_name" name="service_folder_name" value="{{ old('service_folder_name') }}" placeholder="service folder name" required>
        </div>

        <div class="form-group">
            <label for="input3">Parent Folder Name</label>
            <input type="text" class="input" id="parent_folder_name" name="parent_folder_name" value="{{ old('parent_folder_name') }}" placeholder="parent folder name" required>
        </div>

        <div class="form-group">
            <label for="input4">Method Name</label>
            <input type="text" class="input" id="method_name" name="method_name" value="{{ old('method_name') }}" placeholder="method name" required>
        </div>

        <button type="submit" class="button is-primary">Submit</button>
    </form>