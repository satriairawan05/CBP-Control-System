<form action="{{ $formAction }}" method="post" onsubmit="btnsubmit.disabled=true; return true;"
    enctype="multipart/form-data">
    @csrf
    @if (isset($formMethod))
        @method($formMethod)
    @endif
    <div class="form-group">
        <div class="row mb-3">
            <div class="col-6">
                <label for="code">Code <span class="text-danger">*</span> </label>
                <input type="text"
                    class="form-control form-control-sm @error('code')
                                    is-invalid
                                @enderror"
                    id="code" placeholder="Masukan Report Name" value="{{ old('code', $report->code ?? '') }}"
                    name="code" required>
                @error('code')
                    <div class="invalid-feedback">
                        {{ $errors->get('code')[0] }}
                    </div>
                @enderror
            </div>
            <div class="col-6">
                <label for="status">Status <span class="text-danger">*</span> </label>
                <select id="status" class="form-control form-control-sm @error('status') is-invalid @enderror"
                    name="status">
                    @php
                        $status = [['status' => 'Done'], ['status' => 'Cancel'], ['status' => 'Submit']];
                    @endphp
                    <option value="" selected>Without Status</option>
                    @foreach ($status as $s)
                        @if (old('status', $report->status ?? '') == $s['status'])
                            <option value="{{ $s['status'] }}" selected>{{ $s['status'] }}
                            </option>
                        @else
                            <option value="{{ $s['status'] }}">{{ $s['status'] }}</option>
                        @endif
                    @endforeach
                </select>
                @error('status')
                    <div class="invalid-feedback">
                        {{ $errors->get('status')[0] }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <label for="message">Error Message <span class="text-danger">*</span> </label>
                <textarea name="message" class="form-control @error('message') is-invalid @enderror" id="message" rows="10"
                    cols="100">{{ old('message', $report->message ?? '') }}</textarea>
                @error('message')
                    <div class="invalid-feedback">
                        {{ $errors->get('message')[0] }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-6">
                <label for="project_id">Project <span class="text-danger">*</span></label>
                <select id="project" class="form-control @error('project_id') is-invalid @enderror form-control-sm"
                    name="project_id">
                    <option value="" selected>Without Project</option>
                    @foreach ($project as $d)
                        @if (old('project_id', $report->project_id ?? '') == (int) $d->id)
                            <option value="{{ (int) $d->id }}" selected>{{ $d->title }} - {{ $d->code }}
                            </option>
                        @else
                            <option value="{{ (int) $d->id }}">{{ $d->title }} - {{ $d->code }}</option>
                        @endif
                    @endforeach
                </select>
                @error('project_id')
                    <div class="invalid-feedback">
                        {{ $errors->get('project_id')[0] }}
                    </div>
                @enderror
            </div>
            <div class="col-6">
                <label for="task_id">Task <span class="text-danger">*</span></label>
                <select id="task" class="form-control @error('task_id') is-invalid @enderror form-control-sm"
                    name="task_id">
                    <option value="" selected>Without Task</option>
                    @foreach ($task as $d)
                        @if (old('task_id', $report->task_id ?? '') == (int) $d->id)
                            <option value="{{ (int) $d->id }}" selected>{{ $d->feature }} - {{ $d->code }}
                            </option>
                        @else
                            <option value="{{ (int) $d->id }}">{{ $d->feature }} - {{ $d->code }}</option>
                        @endif
                    @endforeach
                </select>
                @error('project_id')
                    <div class="invalid-feedback">
                        {{ $errors->get('project_id')[0] }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <label for="image">Image</label><br>
                <p id="imageFileName" class="d-none"></p>
                <img id="imagePreview" class="d-none" alt="image Preview" style="max-width: 100%; max-height: 150px;">
                <input type="file" id="image"
                    class="form-control @error('image') is-invalid @enderror form-control-sm" name="image"
                    accept=".jpg, .jpeg, .png">
                @error('image')
                    <div class="invalid-feedback">
                        {{ $errors->get('image')[0] }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <label for="budget">Budget </label>
                <span class="input-grou-text">
                    <input type="text" class="form-control form-control-sm @error('budget') is-invalid @enderror"
                        id="budget" placeholder="Masukan Budget" value="{{ old('budget', $report->budget ?? '') }}"
                        name="budget">
                </span>
                @error('budget')
                    <div class="invalid-feedback">
                        {{ $errors->get('budget')[0] }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <a href="{{ $cancelRoute }}" class="btn btn-sm btn-info mx-2"><i class="fa fa-reply-all"></i></a>
                <button type="submit" id="btnsubmit" class="btn btn-sm btn-success">{{ $submitButton }}</button>
            </div>
        </div>
    </div>
</form>

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/select2/css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('js')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/vendor/select2/js/select2.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript" src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script type="text/javascript" src="{{ asset('assets/vendor/ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/angka.js') }}"></script>
    <script>
        $(document).ready(function() {
            CKEDITOR.replace('message');
            $('#status').select2();
            $('#project').select2();
            $('#task').select2();

            $("#budget").on("keyup", function() {
                $("#budget").val(formatAngka(this.value));
            });

            $('#form').on('submit', function() {
                $("#budget").val(unformatAngka($("#budget").val()));
            });

            $("#image").change(function() {
                readURL(this);
            });

            // Fungsi untuk menampilkan preview gambar
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        // Tampilkan preview gambar
                        $("#imagePreview").attr("src", e.target.result);
                        $("#imagePreview").removeClass("d-none");
                        $("#imagePreview").addClass("d-flex mx-auto");

                        // Tampilkan nama file
                        $("#imageFileName").text(input.files[0].name);
                        $("#imageFileName").removeClass("d-none");
                        $("#imageFileName").addClass("text-center");
                    }
                };

                reader.readAsDataURL(input.files[0]);
            }
        });
    </script>
@endpush
