@extends('admin.layouts.app')

@section('breadcrumb')
    <header class="page-header">
        <h2>Dashboard</h2>
        <div class="right-wrapper text-end">
            <ol class="breadcrumbs">
                <li>
                    <a href="{{ route('home') }}">
                        <i class="bx bx-home-alt"></i>
                    </a>
                </li>
                <li><span>Dashboard</span></li>
            </ol>
            <div class="sidebar-right-toggle">
            </div>
        </div>
    </header>
@endsection

@section('app')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia blanditiis eum
                        delectus provident optio ab expedita vitae facilis atque quia amet ea molestias, enim, cum,
                        exercitationem odit. Maxime veritatis doloribus quas excepturi vero officia dolorum aut deleniti
                        neque eos quae voluptatem dolores ipsam, exercitationem quo ea. Nobis hic, quo, minus provident
                        voluptatibus porro sapiente, illum voluptate quas quis magnam repellendus. Veritatis dolores rem
                        necessitatibus deserunt in aliquam, consequatur sequi labore, voluptatibus similique nisi porro
                        dolorum sit ea quae. Veniam nobis provident error dolores. Vero, sint corrupti excepturi
                        perspiciatis esse non itaque eveniet facere! Aspernatur, cum sed. Modi beatae rem laudantium.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
