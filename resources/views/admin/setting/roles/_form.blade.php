<form action="{{ $formAction }}" method="post" onsubmit="btnsubmit.disabled=true; return true;">
    @csrf
    @if(isset($formMethod))
        @method($formMethod)
    @endif
    <div class="form-group">
        <div class="row mb-3">
            <div class="col-2">
                <label for="group_name">Role Name <span class="text-danger">*</span> </label>
            </div>
            <div class="col-10">
                <input type="text"
                    class="form-control form-control-sm @error('group_name')
                                    is-invalid
                                @enderror"
                    id="group_name" placeholder="Masukan Role Name" value="{{ old('group_name', $group->group_name ?? '') }}" name="group_name"
                    required>
                @error('group_name')
                    <div class="invalid-feedback">
                        {{ $errors->get('group_name')[0] }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-3">
                <table class="table-hover text-nowrap table">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 10px">#</th>
                            <th class="text-center">Pages</th>
                            <th class="text-center">Access</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($page_distincts as $d)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-center">{!! str_replace('_', ' ', $d->page_name) !!}</td>
                                <td class="text-center">
                                    @foreach ($pages as $p)
                                        @if (str_replace('_', ' ', $p->page_name) == str_replace('_', ' ', $d->page_name))
                                            <div class="d-inline">
                                                <input type="checkbox" id="{!! $p->page_id !!}"
                                                    name="{!! $p->page_id !!}" {!! $p->access == 1 ? 'checked' : '' !!}>
                                                <label for="{!! $p->page_id !!}">
                                                    {{ $p->action }}
                                                </label>
                                            </div>
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
