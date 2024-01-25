<form action="{{ $formAction }}" method="post" onsubmit="btnsubmit.disabled=true; return true;">
    @csrf
    @if(isset($formMethod))
        @method($formMethod)
    @endif
    <div class="form-group">
        <div class="row mb-3">
            <div class="col-6">
                <label for="title">Title <span class="text-danger">*</span> </label>
                <input type="text"
                    class="form-control form-control-sm @error('title')
                                    is-invalid
                                @enderror"
                    id="title" placeholder="Masukan Title" value="{{ old('title', $contract->title ?? '') }}" name="title"
                    required>
                @error('title')
                    <div class="invalid-feedback">
                        {{ $errors->get('title')[0] }}
                    </div>
                @enderror
            </div>
            <div class="col-6">
                <label for="budget">Budget <span class="text-danger">*</span> </label>
                <input type="text"
                    class="form-control form-control-sm @error('budget')
                                    is-invalid
                                @enderror"
                    id="budget" placeholder="Masukan Budget"
                    value="{{ old('budget', $contract->budget ?? '') }}" name="budget" required>
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

@push('js')
    <script type="text/javascript" src="{{ asset('assets/js/angka.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#budget").on("keyup", function() {
                $("#budget").val(formatAngka(this.value));
            });

            $('#form').on('submit', function() {
                $("#budget").val(unformatAngka($("#budget").val()));
            });
        });
    </script>
@endpush
