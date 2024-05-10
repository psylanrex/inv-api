<!-- Form with POST action -->
<form id="removeServiceForm" action="/api/remove-service" method="post">
        @csrf <!-- CSRF token for Laravel -->

        <div class="form-group">
            <label for="service_name">Service Name</label>
            <input type="text" class="input" id="service_name" name="service_name" value="{{ old('service_name') }}" placeholder="service name" required>
        </div>

        <div class="form-group">
            <label for="service_folder_name">Service Folder Name</label>
            <input type="text" class="input" id="service_folder_name" name="service_folder_name" value="{{ old('service_folder_name') }}" placeholder="service folder name" required>
        </div>

        <div class="form-group">
            <label for="parent_folder_name">Parent Folder Name</label>
            <input type="text" class="input" id="parent_folder_name" name="parent_folder_name" value="{{ old('parent_folder_name') }}" placeholder="parent folder name" required>
        </div>


        <label>
        <input type="radio" name="remove_all_services_in_folder" value="1"> Remove All Related Services
    </label>

    <label>
        <input type="radio" name="remove_all_services_in_folder" value="0"> Do Not Remove Folders
    </label>


        <button type="submit" class="button is-primary" style="margin-top: 50px;">Submit</button>
    </form>