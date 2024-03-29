<form action="{{ $formAction }}" method="post" onsubmit="btnsubmit.disabled=true; return true;">
    @csrf
    @if (isset($formMethod))
        @method($formMethod)
    @endif
    <div class="form-group">
        <div class="row mb-3">
            <div class="col-2">
                <label for="group_name">Role Name <span class="text-danger">*</span> </label>
            </div>
            <div class="col-10">
                <input type="text" class="form-control @error('group_name') is-invalid @enderror" id="group_name"
                    placeholder="Masukan Role Name" value="{{ old('group_name', $group->group_name ?? '') }}"
                    name="group_name">
                @error('group_name')
                    <div class="invalid-feedback">
                        {{ $errors->get('group_name')[0] }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-3">
                <table class="table-hover text-nowrap table" id="myTable">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 10px">#</th>
                            <th class="text-center">Pages</th>
                            <th class="text-center">Create</th>
                            <th class="text-center">Read</th>
                            <th class="text-center">Update</th>
                            <th class="text-center">Delete</th>
                            <th class="text-center">Apply to Completed</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($page_distincts as $d)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-center">{!! str_replace('_', ' ', $d->page_name) . 's' !!}</td>
                                <td class="text-center">
                                    @foreach ($pages as $p)
                                        @if ($p->page_name == $d->page_name && $p->action == 'Create')
                                            <div class="d-inline">
                                                <input type="checkbox" id="{!! $p->page_id !!}"
                                                    name="{!! $p->page_id !!}" {!! $p->access == 1 ? 'checked' : '' !!}>
                                            </div>
                                        @endif
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    @foreach ($pages as $p)
                                        @if ($p->page_name == $d->page_name && $p->action == 'Read')
                                            <div class="d-inline">
                                                <input type="checkbox" id="{!! $p->page_id !!}"
                                                    name="{!! $p->page_id !!}" {!! $p->access == 1 ? 'checked' : '' !!}>
                                            </div>
                                        @endif
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    @foreach ($pages as $p)
                                        @if ($p->page_name == $d->page_name && $p->action == 'Update')
                                            <div class="d-inline">
                                                <input type="checkbox" id="{!! $p->page_id !!}"
                                                    name="{!! $p->page_id !!}" {!! $p->access == 1 ? 'checked' : '' !!}>
                                            </div>
                                        @endif
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    @foreach ($pages as $p)
                                        @if ($p->page_name == $d->page_name && $p->action == 'Delete')
                                            <div class="d-inline">
                                                <input type="checkbox" id="{!! $p->page_id !!}"
                                                    name="{!! $p->page_id !!}" {!! $p->access == 1 ? 'checked' : '' !!}>
                                            </div>
                                        @endif
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    @foreach ($pages as $p)
                                        @if ($p->page_name == $d->page_name && $p->action == 'Apply to Completed')
                                            <div class="d-inline">
                                                <input type="checkbox" id="{!! $p->page_id !!}"
                                                    name="{!! $p->page_id !!}" {!! $p->access == 1 ? 'checked' : '' !!}>
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

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/media/css/dataTables.bootstrap5.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/table.css') }}">
@endpush

@push('js')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets/vendor/datatables/media/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/table.js') }}"></script>
@endpush
