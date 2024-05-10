<P style="margin-bottom: 20px;">A foundation consists of a model, controller, routes, migration, and seeds. 
                                Column names and types are for creating data tables and models. Column 1 must 
                               be filled in and type selected. All other columns are optional. Be sure to choose
                            both column name and type when creating a column. Typically, this will be your_model_name, snake case convention.</p>

<!-- Form with POST action -->
<form id="makeNewServiceForm" action="/api/make-foundation" method="post">
        @csrf <!-- CSRF token for Laravel -->

        <div class="form-group">
            <label for="model">Model</label>
            <input type="text" class="input" id="model" name="model" value="{{ old('model') }}" placeholder="model name" required>
        </div>

        <div class="form-group">
            <label for="controller_folder">Controller Folder Name</label>
            <input type="text" class="input" id="controller_folder" name="controller_folder" value="{{ old('controller_folder') }}" placeholder="controller folder" required>
        </div>
        

        <div class="form-group">
            <label for="controller_type">Controller Type</label>
            <input type="text" class="input" id="controller_type" name="controller_type" value="{{ old('controller_type') }}" placeholder="controller type: Admin, User, etc." required>
        </div>
        
<!-- Custom hr with black-grey color -->
<hr class="custom-hr">

        
        <div class="form-group custom-form-group">
        <label for="column_1_name" class="is-pulled-left" style="margin-bottom: 10px;">Column 1 Name</label>
        <input type="text" class="input" id="column_1_name" name="column_1_name" value="{{ old('column_1_name') }}" placeholder="column 1 name" required>
    </div>

    <div class="form-group custom-form-group">
        <div class="custom-select-group">
            <label for="column_1_type" class="custom-inline-label">Column 1 Type</label>

            <!-- Replace the text input with a dropdown -->
            <div class="custom-select-container">
                <select id="column_1_type" name="column_1_type" class="custom-select" required>
                <option value="" disabled selected>Select an option</option>
                    <option value="boolean" {{ old('column_1_type') == 'boolean' ? 'selected' : '' }}>boolean</option>
                    <option value="date-time" {{ old('column_1_type') == 'date-time' ? 'selected' : '' }}>date-time</option>
                    <option value="text" {{ old('column_1_type') == 'text' ? 'selected' : '' }}>text</option>
                    <option value="integer" {{ old('column_1_type') == 'integer' ? 'selected' : '' }}>integer</option>
                    <option value="string" {{ old('column_1_type') == 'string' ? 'selected' : '' }}>string</option>
                    <option value="string-unique" {{ old('column_1_type') == 'string-unique' ? 'selected' : '' }}>string-unique</option>
                    <option value="text" {{ old('column_1_type') == 'text' ? 'selected' : '' }}>text</option>
                    <option value="unsigned-integer" {{ old('column_1_type') == 'text' ? 'selected' : '' }}>unsigned-integer</option>
                    <!-- Add more options as needed -->
                </select>
            </div>
        </div>

        <!-- Custom hr with black-grey color -->
        <hr class="custom-hr">
    </div>

        @for($i = 2; $i <= 12; $i++)
    <div class="form-group custom-form-group">
        <label for="column_{{ $i }}_name" class="is-pulled-left" style="margin-bottom: 10px;">Column {{ $i }} Name</label>
        <input type="text" class="input" id="column_{{ $i }}_name" value="{{ old('column_' . $i . '_name') }}" name="column_{{ $i }}_name" placeholder="column {{ $i }} name">
    </div>

    <div class="form-group custom-form-group">
        <div class="custom-select-group">
            <label for="column_{{ $i }}_type" class="custom-inline-label">Column {{ $i }} Type</label>

            <!-- Replace the text input with a dropdown -->
            <div class="custom-select-container">
                <select id="column_{{ $i }}_type" name="column_{{ $i }}_type" class="custom-select">
                    <option value="" disabled selected>Select an option</option>
                    <option value="boolean" {{ old('column_' . $i . '_type') == 'boolean' ? 'selected' : '' }}>boolean</option>
                    <option value="boolean-default" {{ old('column_' . $i . '_type') == 'boolean-default' ? 'selected' : '' }}>boolean-default</option>
                    <option value="date-time" {{ old('column_' . $i . '_type') == 'date-time' ? 'selected' : '' }}>date-time</option>
                    <option value="integer" {{ old('column_' . $i . '_type') == 'integer' ? 'selected' : '' }}>integer</option>
                    <option value="string" {{ old('column_' . $i . '_type') == 'string' ? 'selected' : '' }}>string</option>
                    <option value="string-unique" {{ old('column_' . $i . '_type') == 'string-unique' ? 'selected' : '' }}>string-unique</option>
                    <option value="text" {{ old('column_' . $i . '_type') == 'text' ? 'selected' : '' }}>text</option>
                    <option value="unsigned-integer" {{ old('column_' . $i . '_type') == 'text' ? 'selected' : '' }}>unsigned-integer</option>
                    <!-- Add more options as needed -->
                </select>
            </div>
        </div>

        <!-- Custom hr with black-grey color -->
        <hr class="custom-hr">
    </div>
@endfor       

        <button type="submit" class="button is-primary">Submit</button>
    </form>